<?php

namespace App\Http\Livewire\Front\Space\Posts;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\{Carbon, Str};
use Illuminate\Support\Facades\Auth;

use App\Enums\{PublicationStates};

use App\Models\{Company, Media, Mediable, Offer, Post, PostType, Subscription, User};

class Form extends Component
{
	// Entities
	public Company $company;
	public Mediable $mediable;
	public Offer $offer;
	public Post $post;
	public PostType $postType;
	public Subscription $subscription;
	public User $user;

	// Properties
	public $postTypes;
	public $postTypeSelected;
	public $socialNetworkDescription;
	public $changeHasBeenMade = false;
	public $lastPublication;
	public $postState;
	public $active = 1;
	public $totalSteps = 2;
	public $allowUpdate = true;
	public $creditAvailable = 0;

	protected function rules()
	{
		return [
			'postTypeSelected' => [],
			'socialNetworkDescription' => [],
			'description' => []
		];
	}

	#[On('media-added')]
	public function mediaAdded()
	{
		$this->countPostPhotos();
	}

	#[On('media-deleted')]
	public function mediaDeleted()
	{
		$this->countPostPhotos();
	}

	public function goto($index)
	{
		$this->active = $index;
	}

	public function previous()
	{
		if($this->postState == 'create' && $this->active == 3) return redirect()->route('space.posts.update', ['post' => $this->post->slug]);

		$this->active--;
	}

	public function countPostPhotos()
	{
		if($this->postState == 'create') $this->photoCount = Auth::guard('web')->user()->mediable->find($this->mediableIdPhoto)->media->count();
		elseif($this->postState == 'update') $this->photoCount = $this->post->getMedia('photos'.$this->post->id)->count();

		$this->mediasLeft = $this->post->values?->has('identifiant') ? 20 - $this->photoCount : $this->offer->getMaxPhoto() - $this->photoCount;
	}

	public function refreshLastPublication()
	{
		$this->post->load('lastPublication');

		$this->lastPublication = $this->post->lastPublication;

		if($this->lastPublication) {
			$this->subscription = $this->lastPublication->subscription;
			$this->offer = $this->subscription->offer;
		}
		else $this->subscription = $this->user->hasOfferSubscription($this->offer->slug);
	}

	public function setPublication($status)
	{
		$this->refreshLastPublication();

		if($this->postState == 'create') {
			if($status == 'publish') {
				if($this->active < $this->totalSteps) {
					if($this->post->publications()->count() == 0) {
						$this->post->publications()->create([
							'user_id' => $this->user->id,
							'subscription_id' => $this->subscription->id,
							'state' => PublicationStates::Draft
						]);
					}
				}
				elseif($this->active == $this->totalSteps) {
					$this->post->publications()->create([
						'user_id' => $this->user->id,
						'subscription_id' => $this->subscription->id,
						'state' => PublicationStates::DraftWaitingModerationForPublication
					]);

					$this->post->markForModeration();
					$message = __(':element has been created successfully', ['element' => __('Your post')]);
					session()->flash('post_published');
					session()->flash('post_type', $this->postType->getTranslation('slug', 'en'));
				}
			}
			elseif($status == 'draft') {
				if($this->post->publications()->count() == 0) {
					$this->post->publications()->create([
						'user_id' => $this->user->id,
						'subscription_id' => $this->subscription->id,
						'state' => PublicationStates::Draft
					]);
				}

				$message = __(':element has been saved as draft successfully', ['element' => __('Your post')]);
			}
		}
		elseif($this->postState == 'update') {
			if($this->lastPublication->isDraft()) {
				if($status == 'publish') {
					if($this->active == $this->totalSteps) {
						$this->post->publications()->create([
							'user_id' => $this->user->id,
							'subscription_id' => $this->subscription->id,
							'state' => PublicationStates::DraftWaitingModerationForPublication
						]);

						$this->post->markForModeration();
						session()->flash('post_published');
						session()->flash('post_type', $this->postType->getTranslation('slug', 'en'));
					}
				}
				elseif($status == 'buy-and-publish') return redirect()->route('space.posts.buy-to-publish', ['post' => $this->post->slug]);
			}
			elseif($this->lastPublication->isPublished() && $this->changeHasBeenMade) {
				$endDate = null;

				if(!$this->offer->free) $endDate = $this->lastPublication->end_date;

				$this->post->publications()->create([
					'user_id' => $this->user->id,
					'subscription_id' => $this->subscription->id,
					'state' => PublicationStates::PublishedUpdatedWaitingModeration,
					'end_date' => $endDate
				]);

				$this->post->markForModeration();
				session()->flash('post_published_modified');
				session()->flash('post_type', $this->postType->getTranslation('slug', 'en'));
			}
			elseif($this->lastPublication->isWaitingToBePublished() && $this->post->lastModeration->isDenied()) {
				$this->post->markForModeration();
				session()->flash('post_published_modified');
				session()->flash('post_type', $this->postType->getTranslation('slug', 'en'));
			}

			$message = __(':element has been updated successfully', ['element' => __('Your post')]);
		}

		if($status == 'draft' || ($status == 'publish' && $this->active == $this->totalSteps)) return redirect()->route('space.posts.my-posts')->with('success', $message);
	}

	public function submitPostForm($status)
	{
		if($this->active == 1) {
			$rules = [
				'postTypeSelected' => ['required']
			];

			$messages = [
				'postTypeSelected.required' => __(':element is mandatory', ['element' => __('The post type')])
			];

			$this->validate($rules, $messages);

			if($this->postState == 'create') {
				$this->postType = PostType::findBySlug($this->postTypeSelected, 'en');
			}
		}
		elseif($this->active == 2) {
			if($this->postType->getTranslation('slug', 'en') == '') {
				$rules = [
					'' => ['required'],
				];

				$messages = [
					'.required' => __(':element is mandatory', ['element' => __('The ')]),
				];

				$this->validate($rules, $messages);

				if($this->postState == 'create') {
					$values = new Collection();
					$values->put('description', $this->description);

					$this->post = new Post;
					$this->post->user_id = $this->user->id;
					$this->post->post_type_id = $this->postType->id;
					$this->post->name = '';
					$this->post->values = $values;

					$mediablePhotos = Auth::guard('web')->user()->mediable->find($this->mediableIdPhoto);
					$mediaPhotos = $mediablePhotos->media;
					if($mediaPhotos->isNotEmpty()) {
						foreach($mediaPhotos as $mediaPhoto) {
							$this->post->addMedia($mediaPhoto->getPath())
								->usingName($mediaPhoto->name)
								->usingFileName($mediaPhoto->file_name)
								->toMediaCollection('photos'.$this->post->id);

							$mediaPhoto->delete();
						}

						$mediablePhotos->delete();
					}
				}
				elseif($this->postState == 'update') {
					if($this->description != $values->get('description')) {
						$forModeration = $values->get('for_moderation', []);
						$this->changeHasBeenMade = true;

						if($this->description != $values->get('description')) $forModeration['description'] = $this->description;

						$values->put('for_moderation', $forModeration);
					}

					$this->post->values = $values;
				}
			}

			$this->post->save();

			$this->refreshLastPublication();

			if($this->postState == 'create') {
				$this->post->publications()->create([
					'user_id' => $this->user->id,
					'subscription_id' => $this->subscription->id,
					'state' => PublicationStates::Draft
				]);
			}
		}
		elseif($this->active == 3) {
			$rules = [
				'socialNetworkDescription' => ['required']
			];

			$messages = [
				'socialNetworkDescription.required' => __('You must enter a summary for the social network broadcasting')
			];

			$this->validate($rules, $messages);

			$values = $this->post->values;

			if($this->postState == 'create') $values->put('social_network_description', $this->socialNetworkDescription);
			elseif($this->postState == 'update' && $this->socialNetworkDescription != $values->get('social_network_description')) {
				$this->changeHasBeenMade = true;

				$forModeration = $values->get('for_moderation', []);
				$forModeration['social_network_description'] = $this->socialNetworkDescription;

				$values->put('for_moderation', $forModeration);
			}

			$this->post->values = $values;
			$this->post->save();
		}

		if($this->active > 1) $this->setPublication($status);

		if($this->active < $this->totalSteps && $status == 'publish') $this->active++;
		if($this->active == $this->totalSteps) {
			$this->creditAvailable = $this->user->countCreditAvailable($this->offer->slug);

			if($this->postState == 'update' && $this->lastPublication->isDraftWaitingModerationForPublication()) $this->creditAvailable++;
		}
	}

	public function mount()
	{
		$this->postTypes = PostType::where('slug->en', '<>', 'litter-yet-to-come')
			->get();
		$this->user = Auth::guard('web')->user();
		$this->company = $this->user->company;

		$this->mediableClassPhoto = Mediable::class;
		$postMediablePhoto =  Mediable::firstOrCreate([
			'user_id' => $this->user->id,
			'type' => 'post-photo'
		]);
		$this->mediableIdPhoto = $postMediablePhoto->id;

		if($this->post->id) {
			$this->active = 2;
			$this->postState = 'update';
			$this->postType = $this->post->type;
			$this->mediableClassPhoto = Post::class;
			$this->mediableIdPhoto = $this->post->id;
			$this->refreshLastPublication();

			if($this->post->isPublished() && !$this->post->values->has('identifiant')) $this->allowUpdate = false;

			if(data_get($this->litter->values, 'for_moderation.description')) $this->description = data_get($this->litter->values, 'for_moderation.description');
			else $this->description = $this->litter->values->get('description');

			if($this->offer->hasOption('social-network-broadcasting')) {
				if(data_get($this->post->values, 'for_moderation.social_network_description')) $this->socialNetworkDescription = data_get($this->post->values, 'for_moderation.social_network_description');
				else $this->socialNetworkDescription = $this->post->values->get('social_network_description');
			}

			$this->countPostPhotos();

			if($this->active == $this->totalSteps) {
				$this->creditAvailable = $this->user->countCreditAvailable($this->offer->slug);

				if($this->postState == 'update' && $this->lastPublication->isDraftWaitingModerationForPublication()) $this->creditAvailable++;
			}
		}
		else $this->postState = 'create';

		if($this->offer->hasOption('social-network-broadcasting')) $this->totalSteps = 3;
	}

	public function render()
	{
		$this->subComponentKey++;

		return view('livewire.front.space.posts.form');
	}
}
