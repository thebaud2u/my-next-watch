<?php

namespace App\Http\Livewire\Front\Space\Companies;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Enums\PublicationStates;

use App\Models\{Address, City, Country, Department, Region};
use App\Models\{Company, Media, Mediable, Offer, Subscription, User};

use App\Services\EmbedService;
use App\Rules\MediaUrl;

class Form extends Component
{
	use WithFileUploads;

	protected $embedService;

	// Entities
	public Address $address;
	public Company $company;
	public Mediable $mediable;
	public Offer $offer;
	public Subscription $subscription;
	public User $user;

	// Properties
	public $name;
	public $description;
	public $addressArray;
	public $videos = [];
	public $facebook;
	public $instagram;
	public $website;

	// Misc
	public $lastPublication;
	public $companyState = 'create';
	public $active = 1;
	public $totalSteps = 3;
	public $subComponentKey = 0;
	public $changeHasBeenMade = false;
	public $mediableClassLogo;
	public $mediableIdLogo;
	public $collectionLogo;
	public $mediableClassPhotos;
	public $mediableIdPhotos;
	public $collectionPhotos;
	public $photoCount = 0;
	public $mediasLeft = 0;

	// User Values
	public $userInterestedIn;

	protected function rules()
	{
		return [
			'name' => [],
			'addressArray' => [],
			'description' => [],
			'videos' => [],
			'facebook' => [],
			'instagram' => [],
			'website' => []
		];
	}

	#[On('address-selected')]
	public function addressSelected($address)
	{
		$this->addressArray = $address;
	}

	#[On('media-added')]
	public function mediaAdded()
	{
		$this->refreshLastPublication();

		if($this->companyState == 'update' && $this->lastPublication->isPublished()) {
			if(!$this->company->awaitingModeration()) {
				$endDate = null;

				if(!$this->offer->free) $endDate = $this->lastPublication->end_date;

				$this->company->publications()->create([
					'user_id' => $this->user->id,
					'subscription_id' => $this->subscription->id,
					'state' => PublicationStates::PublishedUpdatedWaitingModeration,
					'end_date' => $endDate
				]);

				$this->company->markForModeration();
			}

			session()->flash('company_published_modified');
		}

		$this->countCompanyPhotos();
	}

	#[On('media-deleted')]
	public function mediaDeleted()
	{
		$this->countCompanyPhotos();
	}

	public function countCompanyPhotos()
	{
		if($this->companyState == 'create') $model = Auth::guard('web')->user()->mediable->find($this->mediableIdPhotos);
		elseif($this->companyState == 'update') $model = $this->company;

		$this->photoCount = $model->getMedia('photos')->count();
		$this->mediasLeft = $this->offer->getMaxPhoto() - $this->photoCount;
	}

	public function previous()
	{
		if($this->active == 3) {
			if($this->offer->hasOption('display-breeders')) $this->active--;
			else $this->active = $this->active - 2;
		}
		else $this->active--;
	}

	public function goto($index)
	{
		$this->active = $index;
	}

	public function setAddress()
	{
		if($this->companyState == 'create') {
			if($this->company->address()->count() > 0) $this->company->address->delete();

			$country = Country::find($this->addressArray['country_id']);

			if($country) {
				if($country->code == 'FRA') {
					$this->addressArray['custom_postcode'] = null;
					$this->addressArray['custom_province'] = null;
					$this->addressArray['custom_city'] = null;
				}
				elseif($country->code == 'BEL') {
					$this->addressArray['region_id'] = null;
					$this->addressArray['department_id'] = null;
					$this->addressArray['city_id'] = null;
				}
			}

			$this->company->address()->create($this->addressArray);
		}
		elseif($this->companyState == 'update') {
			$current = $this->address->only([
				'country_id',
				'city_id',
				'custom_city',
				'street',
				'department_id',
				'region_id',
				'custom_postcode',
				'custom_province',
			]);

			$new = collect($this->addressArray)->only(array_keys($current))->toArray();

			if(array_diff_assoc($new, $current) || array_diff_assoc($current, $new)) {
				if($address = $this->company->addressForModeration) $address->delete();

				$this->addressArray['for_moderation'] = true;
				$this->company->address()->create($this->addressArray);
			}
		}
	}

	public function refreshLastPublication()
	{
		$this->company->load('lastPublication');

		$this->lastPublication = $this->company->lastPublication;

		if($this->lastPublication) {
			$this->subscription = $this->lastPublication->subscription;
			$this->offer = $this->subscription->offer;
		}
		else $this->subscription = $this->user->hasOfferSubscription($this->offer->slug);
	}

	public function setPublication($status)
	{
		$this->refreshLastPublication();

		if($this->companyState == 'create') {
			if($status == 'publish') {
				if($this->active < $this->totalSteps) {
					if($this->company->publications()->count() == 0) {
						$this->company->publications()->create([
							'user_id' => $this->user->id,
							'subscription_id' => $this->subscription->id,
							'state' => PublicationStates::Draft
						]);
					}
				}
				elseif($this->active == $this->totalSteps) {
					$this->company->publications()->create([
						'user_id' => $this->user->id,
						'subscription_id' => $this->subscription->id,
						'state' => PublicationStates::DraftWaitingModerationForPublication
					]);

					$this->company->markForModeration();
					$message = __(':element has been created successfully', ['element' => __('Your company page')]);
					session()->flash('company_published');
				}
			}
			elseif($status == 'draft') {
				if($this->company->publications()->count() == 0) {
					$this->company->publications()->create([
						'user_id' => $this->user->id,
						'subscription_id' => $this->subscription->id,
						'state' => PublicationStates::Draft
					]);
				}

				$message = __(':element has been saved as draft successfully', ['element' => __('Your company page')]);
			}
		}
		elseif($this->companyState == 'update') {
			if($this->lastPublication->isDraft()) {
				if($status == 'publish') {
					if($this->active == $this->totalSteps) {
						$this->company->publications()->create([
							'user_id' => $this->user->id,
							'subscription_id' => $this->subscription->id,
							'state' => PublicationStates::DraftWaitingModerationForPublication
						]);

						$this->company->markForModeration();
						session()->flash('company_published');
					}
				}
			}
			elseif($this->lastPublication->isPublished() && $this->changeHasBeenMade) {
				$endDate = null;

				if(!$this->offer->free) $endDate = $this->lastPublication->end_date;

				$this->company->publications()->create([
					'user_id' => $this->user->id,
					'subscription_id' => $this->subscription->id,
					'state' => PublicationStates::PublishedUpdatedWaitingModeration,
					'end_date' => $endDate
				]);

				$this->company->markForModeration();
				session()->flash('company_published_modified');
			}
			elseif($this->lastPublication->isWaitingToBePublished() && $this->company->lastModeration->isDenied()) {
				$this->company->markForModeration();
				session()->flash('company_published_modified');
			}

			$message = __(':element has been updated successfully', ['element' => __('Your company page')]);
		}

		if($status == 'draft' || ($status == 'publish' && $this->active == $this->totalSteps)) return redirect(route('space.companies.my-company'))->with('success', $message);
	}

	public function submitCompanyForm($status)
	{
		$this->embedService = new EmbedService;

		if($this->active == 1) {
			$rules = [
				'name' => ['required', 'min:2', 'max:125'],
				'description' => ['required', 'min:2'],
				'addressArray.street' => ['required'],
				'addressArray.custom_city' => ['required_without:addressArray.city_id'],
				'addressArray.city_id' => ['required_without:addressArray.custom_city'],
				'facebook' => ['nullable', 'url:http,https'],
				'instagram' => ['nullable', 'url:http,https'],
				'website' => ['nullable', 'url:http,https']
			];

			$messages = [
				'name.required' => __(':element is mandatory', ['element' => __('Your company\'s name')]),
				'name.min' => __('Your :element must be :x characters minimum', ['element' => __('company\'s name'), 'x' => 2]),
				'name.max' => __('Your :element must be :x characters maximum', ['element' => __('company\'s name'), 'x' => 125]),
				'description.required' => __(':element is mandatory', ['element' => __('Your company\'s description')]),
				'description.min' => __('Your :element must be :x characters minimum', ['element' => __('company\'s description'), 'x' => 2]),
				'addressArray.street.required' => __(':element is mandatory', ['element' => __('Your street')]),
				'addressArray.custom_city.required_without' => __(':element is mandatory', ['element' => __('Your city')]),
				'addressArray.city_id.required_without' => __(':element is mandatory', ['element' => __('Your city')]),
				'facebook.url' => __('An http or https url is needed'),
				'instagram.url' => __('An http or https url is needed'),
				'website.url' => __('An http or https url is needed'),
			];

			if($this->offer->hasOption('4-video')) {
				foreach($this->videos as $key => $video) {
					if($video) {
						$isEmbedUrl = $this->embedService->isEmbedUrl($video);

						if(!$isEmbedUrl) {
							$videoEmbed = $this->embedService->convertToEmbed($video);

							if(is_null($videoEmbed)) {
								$rules['videos.'.$key] = [new MediaUrl];
								$messages['videos.'.$key] = 'Le lien du média '.($key+1).' n\'est pas correct';
							}
						}
					}
				}
			}

			// Address validation sharing errors with livewire child componant Address
			if((is_null($this->addressArray['street']) || empty($this->addressArray['street'])) || (is_null($this->addressArray['custom_city']) && is_null($this->addressArray['city_id']))) $this->dispatch('address-validation-error');

			$this->validate($rules, $messages);

			if($this->companyState == 'create') {
				$values = new Collection();

				$values->put('facebook', $this->facebook)
					->put('instagram', $this->instagram)
					->put('website', $this->website);

				if($this->offer->hasOption('4-video')) {
					$videos = [];

					foreach($this->videos as $video) {
						if($video) {
							$isEmbedUrl = $this->embedService->isEmbedUrl($video);

							if(!$isEmbedUrl) {
								$videoEmbed = $this->embedService->convertToEmbed($video);

								$videos[] = $videoEmbed;
							}
							else $videos[] = $video;
						}
					}

					$values->put('videos', $videos);
				}

				$this->company->user_id = $this->user->id;
				$this->company->name = $this->name;
				$this->company->description = $this->description;

				// The Media associated with a Mediable is taken back and transferred to the newly created company
				$mediableLogo = $this->user->mediable->where('type', 'company-logo')->first();
				$mediaLogo = $mediableLogo->media->first();

				if($mediaLogo) {
					$this->company->addMedia($mediaLogo->getPath())
						->usingName($mediaLogo->name)
						->usingFileName($mediaLogo->file_name)
						->toMediaCollection('logo');

					$mediaLogo->delete();
					$mediableLogo->delete();
				}

				$mediablePhotos = $this->user->mediable->where('type', 'company-photos')->first();
				$mediaPhotos = $mediablePhotos->media;
				if($mediaPhotos->isNotEmpty()) {
					foreach($mediaPhotos as $mediaPhoto) {
						$this->company->addMedia($mediaPhoto->getPath())
							->usingName($mediaPhoto->name)
							->usingFileName($mediaPhoto->file_name)
							->toMediaCollection('photos');

						$mediaPhoto->delete();
					}

					$mediablePhotos->delete();
				}

				$this->setAddress();
			}
			elseif($this->companyState == 'update') {
				$this->company->description = $this->description;
				$values = $this->company->values;
				$values->put('facebook', $this->facebook)
					->put('instagram', $this->instagram)
					->put('website', $this->website);

				if($this->offer->hasOption('4-video')) {
					$videos = [];

					foreach($this->videos as $video) {
						if($video) {
							$isEmbedUrl = $this->embedService->isEmbedUrl($video);

							if(!$isEmbedUrl) {
								$videoEmbed = $this->embedService->convertToEmbed($video);

								$videos[] = $videoEmbed;
							}
							else $videos[] = $video;
						}
					}
				}

				if(
					($this->company->name != $this->name) ||
					($this->offer->hasOption('4-video') && $values->get('videos') != $videos)
				) {
					$this->changeHasBeenMade = true;

					$forModeration = $values->get('for_moderation', []);

					if($this->company->name != $this->name) $forModeration['name'] = $this->name;
					if($this->offer->hasOption('4-video') && $values->get('videos') != $videos) $forModeration['videos'] = $videos;

					$values->put('for_moderation', $forModeration);

					session()->flash('warning', __('Your updates needs to be moderated to be displayed. The customer service will moderate your updates as soon as possible.'));
				}

				$this->setAddress();
			}

			$this->company->values = $values;
			$this->company->save();
		}

		$this->setPublication($status);

		if($this->active < $this->totalSteps && $status == 'publish') $this->active++;
	}

	public function mount()
	{
		$this->user = Auth::guard('web')->user();

		if($this->company->id) {
			$this->companyState = 'update';

			$this->refreshLastPublication();

			$this->mediableClassLogo = Company::class;
			$this->mediableIdLogo = $this->company->id;
			$this->collectionLogo = 'logo';

			$this->mediableClassPhotos = Company::class;
			$this->mediableIdPhotos = $this->company->id;
			$this->collectionPhotos = 'photos';

			$this->address = $this->company->addressForModeration ?? $this->company->address ?? new Address();

			$this->facebook = $this->company->values->get('facebook');
			$this->instagram = $this->company->values->get('instagram');
			$this->website = $this->company->values->get('website');

			if(data_get($this->company->values, 'for_moderation.name')) $this->name = data_get($this->company->values, 'for_moderation.name');
			else $this->name = $this->company->name;

			if(data_get($this->company->values, 'for_moderation.description')) $this->description = data_get($this->company->values, 'for_moderation.description');
			else $this->description = $this->company->description;

			if($this->offer->hasOption('4-video')) {
				if(data_get($this->company->values, 'for_moderation.videos')) $this->videos = data_get($this->company->values, 'for_moderation.videos');
				else $this->videos = $this->company->values->get('videos') ?? [];
			}
		}
		else {
			$this->mediableClassLogo = Mediable::class;
			$companyMediableLogo =  Mediable::firstOrCreate([
				'user_id' => $this->user->id,
				'type' => 'company-logo'
			]);
			$this->mediableIdLogo = $companyMediableLogo->id;
			$this->collectionLogo = 'logo';

			$this->mediableClassPhotos = Mediable::class;
			$companyMediablePhotos = Mediable::firstOrCreate([
				'user_id' => $this->user->id,
				'type' => 'company-photos'
			]);
			$this->mediableIdPhotos = $companyMediablePhotos->id;
			$this->collectionPhotos = 'photos';

			if($this->user->address) $this->address = $this->user->address;
			else $this->address = new Address;

			$this->companyState = 'create';
		}

		$this->countCompanyPhotos();
	}

	public function render()
	{
		$this->subComponentKey++;

		return view('livewire.front.space.companies.form');
	}
}
