<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

use Spatie\MediaLibrary\Conversions\FileManipulator;

use App\Enums\{ModerationStates, PublicationStates, CommentStates};

use App\Models\{Company, Moderation, Post, Response, Comment, User, UsersViews};

use App\Support\{ModerationCompanyDenyReasons, ModerationPostDenyReasons, ModerationCommentDenyReasons, ModerationUserDenyReasons};

class ModerationController extends Controller
{
	/**
	 * Moderation index
	 */
	public function index(): view
	{
		return view('admin.moderations.index');
	}

	public function moderate(Moderation $moderation): View
	{
		if($moderation->model instanceof Company) {
			$type = 'company';
			$reasons = ModerationCompanyDenyReasons::options();
		}
		elseif($moderation->model instanceof Post) {
			$type = 'post';
			$reasons = ModerationPostDenyReasons::options();
		}
		elseif($moderation->model instanceof Comment) {
			$type = 'comment';
			$reasons = ModerationCommentDenyReasons::options();
		}
		elseif($moderation->model instanceof User) {
			$type = 'user';
			$reasons = ModerationUserDenyReasons::options();
		}

		return view('admin.moderations.moderate', [
			'moderation' => $moderation,
			'type' => $type,
			'reasons' => $reasons
		]);
	}

	public function updateComment(Request $request): RedirectResponse
	{
		$moderation = Moderation::find($request->moderation_id);

		if($moderation) {
			$moderation->model->content = $request->input('newContent');
			$moderation->model->save();

			return redirect()->route('admin.moderations.moderate', ['moderation' => $moderation]);
		}
	}

	public function preview(Moderation $moderation): View
	{
		$company = $moderation->model;
		$name = data_get($moderation->model->values, 'for_moderation.name') ? data_get($moderation->model->values, 'for_moderation.name') : $moderation->model->name;
		$userId = $moderation->model->user->id;
		$addressMain = $moderation->model->addressForModeration ? $moderation->model->displayPartOfAddressForModeration('department+country') : $moderation->model->displayPartOfAddress('department+country');
		$addressPart = $moderation->model->addressForModeration ? $moderation->model->displayPartOfAddressForModeration('department+zipcode+city') : $moderation->model->displayPartOfAddress('department+zipcode+city');
		$medias = [];
		$hasContacted = false;
		$response = new Response;

		if($company->offer()->hasOption('contact-button')) {
			if(Auth::guard('web')->check()) {
				$hasContacted = Auth::guard('web')->user()->hasContacted($company);

				if($hasContacted) {
					$response = Response::whereHasMorph('model', [Company::class], function($whereHasMorph) use($company) {
							$whereHasMorph->where('id', $company->id);
						})
						->whereHas('from', function($whereHas) {
							$whereHas->where('id', Auth::guard('web')->user()->id);
						})
						->whereHas('to', function($whereHas) use($company) {
							$whereHas->where('id', $company->user->id);
						})
						->first();
				}
			}
		}

		foreach($company->getMedia('photos') as $photo) {
			array_push($medias, ['type' => 'image', 'url' => $photo->getAvailableUrl(['optimized'])]);
		}

		if($company->values->has('videos')) {
			foreach($company->values->get('videos') as $value) {
				array_push($medias, ['type' => 'video', 'url' => $value]);
			}
		}


		return view('admin.moderations.preview', [
			'addressMain' => $addressMain,
			'addressPart' => $addressPart,
			'company' => $company,
			'description' => $moderation->model->description,
			'hasContacted' => $hasContacted,
			'logo' => $company->getFirstMedia('logo'),
			'medias' => json_encode($medias),
			'name' => $name,
			'photos' => $company->getMedia('photos'),
			'response' => $response,
			'userId' => $moderation->model->user->id,
		]);
	}

	public function validateCompany(Company $company): void
	{
		$lastPublication = $company->lastPublication;
		$creditConsumed = false;
		$updateOnly = false;

		// Si l'offre est gratuite on a un crédit à consomer dans tous les cas
		// si c'est une modification de contenu de la page entreprise, on doit pas retirer de crédit
		// mais on doit ajouter une ligne de publication avec la date précédente
		// donc si c'est une publication, ou un upgrade, c'est +1 an
		// sinon, on garde la date de la publication précédente
		if($lastPublication->state != PublicationStates::PublishedUpdatedWaitingModeration) $creditConsumed = $company->consumeCredit();
		else $updateOnly = true;

		if($creditConsumed || $updateOnly) {
			if($creditConsumed) {
				$endDate = $lastPublication->subscription->offer->free ? null : Carbon::now()->addYear();
				$subscription = $creditConsumed;
			}
			elseif($updateOnly) {
				$subscription = $lastPublication->subscription;
				$endDate = $subscription->offer->free ? null : $subscription->end_date;
			}

			$company->publications()->create([
				'user_id' => $company->user->id,
				'subscription_id' => $subscription->id,
				'state' => PublicationStates::Published,
				'end_date' => $endDate
			]);

			if($company->values->has('for_moderation')) {
				$forModerationValues = $company->values->get('for_moderation');
				$values = $company->values;

				if(isset($forModerationValues['name'])) {
					$company->name = $forModerationValues['name'];
					$company->generateSlug();
				}

				if(isset($forModerationValues['description'])) $company->description = $forModerationValues['description'];

				if(isset($forModerationValues['affix']) || isset($forModerationValues['affix_name'])) {
					if(isset($forModerationValues['affix'])) $values->put('affix', $forModerationValues['affix']);
					if(isset($forModerationValues['affix_name'])) $values->put('affix_name', $forModerationValues['affix_name']);

					if($company->animals->isNotEmpty()) {
						foreach($company->animals as $animal) {
							$animalValues = $animal->values;

							if(isset($forModerationValues['affix'])) $animalValues->put('affix', $forModerationValues['affix']);
							if(isset($forModerationValues['affix_name'])) $animalValues->put('affix_name', $forModerationValues['affix_name']);

							$animal->values = $animalValues;
							$animal->save();
						}
					}
				}

				if(isset($forModerationValues['facebook'])) $values->put('facebook', $forModerationValues['facebook']);
				if(isset($forModerationValues['instagram'])) $values->put('instagram', $forModerationValues['instagram']);
				if(isset($forModerationValues['videos'])) $values->put('videos', $forModerationValues['videos']);

				$company->values = $values;
				$company->removeValue('for_moderation');
				$company->save();
			}

			if($company->addressForModeration) {
				$company->address->delete();
				$company->addressForModeration()->update(['for_moderation' => false]);
			}
		}
		else $company->markForModeration();
	}

	public function denyCompany(Company $company): void
	{
		if($company->values->has('for_moderation')) {
			$company->removeValue('for_moderation');
			$company->save();
		}
	}

	public function validatePost(Post $post, bool $canSendEmail = false): void
	{
		$lastPublication = $post->lastPublication;
		$creditConsumed = false;
		$updateOnly = false;

		// Si l'offre est gratuite on a un crédit à consomer dans tous les cas
		// si c'est une modification de contenu de l'annonce, on doit pas retirer de crédit
		// mais on doit ajouter une ligne de publication avec la date précédente
		// donc si c'est une publication c'est +3 mois
		// sinon, on garde la date de la publication précédente
		if($lastPublication->state != PublicationStates::PublishedUpdatedWaitingModeration) $creditConsumed = $post->consumeCredit();
		else $updateOnly = true;

		if($creditConsumed || $updateOnly) {
			if($creditConsumed) {
				$endDate = $lastPublication->subscription->offer->free ? null : Carbon::now()->addMonths(3);
				$subscription = $creditConsumed;
			}
			elseif($updateOnly) {
				$subscription = $lastPublication->subscription;
				$endDate = $subscription->offer->free ? null : $subscription->end_date;
			}

			$post->publications()->create([
				'user_id' => $post->user->id,
				'subscription_id' => $subscription->id,
				'state' => PublicationStates::Published,
				'end_date' => $endDate
			]);

			if($post->type->getTranslation('slug', 'en') == '') {

			}

			$post->published_at = Carbon::now();
			$post->refreshed_at = Carbon::now();
			$post->archived_at = $endDate;
			$post->save();

			if($canSendEmail) $post->sendPublicationEmail();
		}
		else $post->markForModeration();
	}

	public function denyPost(Post $post): void
	{
		if($post->model->values->has('for_moderation')) {
			$post->model->removeValue('for_moderation');
			$post->model->save();
		}
	}

	public function decision(Request $request): RedirectResponse
	{
		$moderation = Moderation::find($request->moderation_id);

		if($moderation) {
			$newModeration = new Moderation;
			$newModeration->model()->associate($moderation->model);

			if($request->decision == 'validated') {
				$newModeration->state = ModerationStates::Validated;

				elseif($moderation->model instanceof Company) {
					$this->validateCompany($moderation->model);

					if($moderation->model->hasBeenPublished()) {
						$postsWaitingFirstPublication = $moderation->model->user->posts()->whereHas('lastModeration', function($whereHas) {
								$whereHas->where('state', ModerationStates::Validated);
							})
							->whereHas('lastPublication', function($whereHas) {
								$whereHas->where('state', PublicationStates::DraftWaitingModerationForPublication);
							})
							->get();

						if($postsWaitingFirstPublication->isNotEmpty()) {
							foreach($postsWaitingFirstPublication as $post) {
								$this->validatePost($post, true);
							}
						}
					}
				}
				// In order to publish a post, the company must have been moderated (and validated)
				elseif($moderation->model instanceof Post && $moderation->model->user->company && $moderation->model->user->company->hasBeenValidated() && $moderation->model->user->company->isPublished()) {
					$this->validatePost($moderation->model);
				}
				elseif($moderation->model instanceof Comment) {
					if($request->input('newContent')) $moderation->model->content = $request->input('newContent');

					$moderation->model->state = CommentStates::Published;
					$moderation->model->save();
				}
			}
			elseif($request->decision == 'denied') {
				$newModeration->state = ModerationStates::Denied;
				$newModeration->reason = $request->reason;
				$newModeration->description = $request->description;

				if($moderation->model instanceof Company) $this->denyCompany($moderation->model);
				elseif($moderation->model instanceof Post) $this->denyPost($moderation->model);
				elseif($moderation->model instanceof Comment) {
					$moderation->model->state = CommentStates::Denied;
					$moderation->model->save();
				}
				elseif($moderation->model instanceof User) $this->denyUser($moderation->model);
			}

			$newModeration->admin_id = Auth::guard('admin')->user()->id;
			$newModeration->save();

			return redirect(route('admin.moderations.index'))->with('success', __('Moderation saved successfully'));
		}
		else return redirect(route('admin.moderations.index'))->with('error', __('Moderation not found'));
	}
}
