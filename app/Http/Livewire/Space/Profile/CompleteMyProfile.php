<?php

namespace App\Http\Livewire\Front\Space\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;

use App\Enums\PublicationStates;

use App\Models\{Address, Country, User};

class CompleteMyProfile extends Component
{
	use WithFileUploads;

	public User $user;
	public Address $address;

	public $active = 1;
	public $totalSteps = 2;
	public $userState = 'create';
	public $userHasBeenValidated = false;
	public $changesHasBeenMade = false;

	public $phone;

	// Applicant
	public $placeConfiguration;

	// Professionnal breeders
	public $siret;
	public $companyName;
	public $sirenDocument;

	public $addressArray;
	public $city;

	protected function rules()
	{
		return [
			'placeConfiguration' => [],
			'phone' => [],
			'role' => [],
			'siret' => [],
			'companyName' => [],
			'addressArray.street' => [],
			'addressArray.city_id' => [],
			'identityCard' => [],
			'sirenDocument' => []
		];
	}

	#[On('address-selected')]
	public function addressSelected($address)
	{
		$this->addressArray = $address;
	}

	public function setAddress()
	{
		if($this->user->address()->count() > 0) {
			if($this->user->address->country->id != $this->addressArray['country_id']) {
				$this->user->address->delete();

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

				$this->user->address()->create($this->addressArray);
			}
			else $this->user->address->update($this->addressArray);
		}
		else $this->user->address()->create($this->addressArray);

		$this->address = $this->user->address()->first();
	}

	public function goto($index)
	{
		$this->active = $index;
	}

	public function previous()
	{
		$this->active--;
	}

	public function removeSirenFile(): void
	{
		$this->sirenDocument = null;
	}

	public function submitForm()
	{
		if($this->user->hasRole('applicant')) {
			if($this->active == 1) {
				$this->user->updateValue('place_configuration', $this->placeConfiguration);
				$this->user->updateValue('household_composition', $this->householdComposition);
				$this->user->save();
			}
			elseif($this->active == 2) {
				$rules = [
					'phone' => ['nullable', 'phone:BE,FR']
				];

				$messages = [
					'phone.phone' => __('Your phone number format is invalid')
				];

				$this->validate($rules, $messages);

				$this->user->phone = $this->phone;
				$this->user->save();

				$this->setAddress();
			}
		}
		elseif($this->user->hasRole('recruiter')) {
			elseif($this->active == 1) {
				$rules = [
					'phone' => ['required', 'phone:BE,FR'],
					'addressArray.street' => ['required'],
					'addressArray.custom_city' => ['required_without:addressArray.city_id'],
					'addressArray.city_id' => ['required_without:addressArray.custom_city']
				];

				$messages = [
					'phone.required' => __(':element is mandatory', ['element' => __('Your phone number')]),
					'phone.phone' => __('Your phone number format is invalid'),
					'addressArray.street.required' => __(':element is mandatory', ['element' => __('Your street')]),
					'addressArray.custom_city.required_without' => __(':element is mandatory', ['element' => __('Your city')]),
					'addressArray.city_id.required_without' => __(':element is mandatory', ['element' => __('Your city')])
				];

				// Address validation sharing errors with livewire child componant Address
				if((is_null($this->addressArray['street']) || empty($this->addressArray['street'])) || (is_null($this->addressArray['custom_city']) && is_null($this->addressArray['city_id']))) $this->dispatch('address-validation-error');

				if($this->addressArray['country_id'] == '19') $rules['siret'] = ['required'];
				else {
					$rules['siret'] = ['required', 'numeric', 'min_digits:14', 'max_digits:14'];
					$messages['siret.min_digits'] = __('Your :element must be :x digits minimum', ['element' => __('Siret'), 'x' => 14]);
					$messages['siret.max_digits'] = __('Your :element must be :x digits maximum', ['element' => __('Siret'), 'x' => 14]);
				}

				$rules['companyName'] = ['required', 'string', 'min:2', 'max:255'];

				$messages['siret.required'] = __(':element is mandatory', ['element' => __('Your Siret number')]);
				$messages['companyName.required'] = __(':element is mandatory', ['element' => __('Your company name')]);
				$messages['companyName.min'] = __('Your :element must be :x characters minimum', ['element' => __('Your company name'), 'x' => 2]);
				$messages['companyName.max'] = __('Your :element must be :x characters maximum', ['element' => __('Your company name'), 'x' => 255]);

				$this->validate($rules, $messages);

				if($this->userState == 'create') {
					$this->user->updateValue('siret', $this->siret);
					$this->user->updateValue('company_name', $this->companyName);
				}
				elseif($this->userState == 'update') {
					if($this->user->values->get('siret') != $this->siret || $this->user->values->get('company_name') != $this->companyName) {
						$forModeration = $this->user->values->get('for_moderation', []);

						if($this->user->values->get('siret') != $this->siret) $forModeration['siret'] = $this->siret;
						if($this->user->values->get('company_name') != $this->companyName) $forModeration['company_name'] = $this->companyName;

						$this->user->updateValue('for_moderation', $forModeration);
						$this->user->markForModeration();
					}
				}

				$this->user->phone = $this->phone;
				$this->user->save();

				$this->setAddress();
			}
			elseif($this->active == 2) {
				$needValidation = false;

				if(($this->userHasBeenValidated && !is_null($this->sirenDocument)) || (!$this->userHasBeenValidated && is_null($this->user->values->get('siren_document')))) {
					$needValidation = true;

					$rules['sirenDocument'] = ['required', 'file', 'mimes:pdf,jpg,png', 'max:12288'];

					$messages['sirenDocument.required'] = __(':element is mandatory', ['element' => __('Your Siren document')]);
					$messages['sirenDocument.file'] =  __(':element is expected', ['element' => __('A file')]);
					$messages['sirenDocument.mimes'] = __(':element of the following format is expected : :format', ['element' => __('A file'), 'format' => 'pdf, jpg, png']);
					$messages['sirenDocument.max'] = __(':size maximum', ['size' => '12mo']);
				}

				if($needValidation) {
					$this->validate($rules, $messages);

					$this->user->markForModeration();

					if(($this->userHasBeenValidated && !is_null($this->sirenDocument)) || !$this->userHasBeenValidated) {
						$sirenDocumentPath = $this->sirenDocument->store('breedersDocuments', 'private');
						$this->user->updateValue('siren_document', $sirenDocumentPath);
					}
				}
			}
		}

		$this->user->save();

		if($this->active < $this->totalSteps) $this->active++;
		else {
			if($this->userState == 'create') session()->flash('profile_completed');
			elseif($this->userState == 'update' && $this->changesHasBeenMade) session()->flash('profile_completed');

			return redirect()->route('space.profile.dashboard');
		}
	}

	public function mount($setActiveStep = null)
	{
		$this->user = Auth::guard('web')->user();
		$this->userHasBeenValidated = $this->user->hasBeenValidated();

		if($this->user->profileCompletionPercentage() < 100 && !$this->userHasBeenValidated) $this->userState = 'create';
		else $this->userState = 'update';

		if($this->user->address) $this->address = $this->user->address()->first();
		else $this->address = new Address;

		if($this->user->hasRole('recruiter')) {
			$this->siret = $this->user->values->get('siret');
			$this->companyName = $this->user->values->get('company_name');
		}
		elseif($this->user->hasRole('applicant')) {
			$this->placeConfiguration = $this->user->values->get('place_configuration');
		}

		$this->phone = $this->user->phone;

		if(!is_null($setActiveStep)) $this->active = $setActiveStep;
	}

	public function render()
	{
		return view('livewire.front.space.profile.complete-my-profile');
	}
}
