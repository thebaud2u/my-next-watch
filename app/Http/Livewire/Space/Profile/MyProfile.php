<?php

namespace App\Http\Livewire\Front\Space\Profile;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;

use App\Models\{Address, Country, User};

class MyProfile extends Component
{
	public User $user;
	public Address $address;

	// Commun Adoter/Breeder
	public $firstname;
	public $lastname;
	public $phone;
	public $addressArray;
	public $interestedIn;

	// Adopter
	public $placeConfiguration;
	public $homeAnimals = [];
	public $animalExperience;
	public $householdComposition = [];
	public $adoptionProject;

	//Breeder
	public $siret;
	public $companyName;

	protected function rules()
	{
		return [
			'firstname' => [],
			'lastname' => [],
			'phone' => [],
			'region' => [],
			'interestedIn' => [],
			'placeConfiguration' => [],
			'homeAnimals' => [],
			'animalExperience' => [],
			'householdComposition' => [],
			'adoptionProject' => []
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
					} elseif($country->code == 'BEL') {
						$this->addressArray['region_id'] = null;
						$this->addressArray['department_id'] = null;
						$this->addressArray['city_id'] = null;
					}
				}

				$this->user->address()->create($this->addressArray);
			} else $this->user->address->update($this->addressArray);
		} else $this->user->address()->create($this->addressArray);

		$this->address = $this->user->address()->first();
	}

	public function updateUserInfo()
	{
		$rules = [
			'firstname' => ['nullable', 'string', 'min:2', 'max:125'],
			'lastname' => ['nullable', 'string', 'min:2', 'max:125']
		];

		$messages = [
			'firstname.string' => __('There can\'t be any numerals in your :element', ['element' => __('firstname')]),
			'firstname.min' => __('Your :element must be :x caracters minimum', ['element' => __('firstname'), 'x' => 2]),
			'firstname.max' => __('Your :element must be :x caracters maximum', ['element' => __('firstname'), 'x' => 125]),
			'lastname.string' => __('There can\'t be any numerals in your :element', ['element' => __('lastname')]),
			'lastname.min' => __('Your :element must be :x caracters minimum', ['element' => __('lastname'), 'x' => 2]),
			'lastname.max' => __('Your :element must be :x caracters maximum', ['element' => __('lastname'), 'x' => 125])
		];

		if($this->user->hasRole('recruiter')) {
			$rules['phone'] = 'required';
			$rules['addressArray.street'] = 'required';
			$rules['addressArray.custom_city'] = ['required_without:addressArray.city_id'];
			$rules['addressArray.city_id'] = ['required_without:addressArray.custom_city'];

			$messages['phone.required'] = __(':element is mandatory', ['element' => __('Your phone number')]);
			$messages['addressArray.street.required'] = __(':element is mandatory', ['element' => __('Your street')]);
			$messages['addressArray.custom_city.required_without'] = __(':element is mandatory', ['element' => __('Your city')]);
			$messages['addressArray.city_id.required_without'] = __(':element is mandatory', ['element' => __('Your city')]);

			// Address validation sharing errors with livewire child componant Address
			if(is_null($this->addressArray['street']) || (is_null($this->addressArray['custom_city']) && is_null($this->addressArray['city_id']))) $this->dispatch('address-validation-error');
		}

		$this->validate($rules, $messages);

		$this->user->firstname = $this->firstname;
		$this->user->lastname = $this->lastname;
		$this->user->name = $this->firstname . ' ' . $this->lastname;
		$this->user->phone = $this->phone;
		$this->user->save();

		$this->setAddress();
	}

	public function mount()
	{
		$this->user = Auth::guard('web')->user();
		$this->firstname = $this->user->firstname;
		$this->lastname = $this->user->lastname;
		$this->phone = $this->user->phone;

		if($this->user->address) $this->address = $this->user->address()->first();
		else $this->address = new Address;

		$this->interestedIn = $this->user->values->get('interested_in');
		$this->placeConfiguration = $this->user->values->get('place_configuration');
		$this->homeAnimals = $this->user->values->get('home_animals');
		$this->animalExperience = $this->user->values->get('animal_experience');
		$this->householdComposition = $this->user->values->get('household_composition');
		$this->adoptionProject = $this->user->values->get('adoption_project');

		if(data_get($this->user->values, 'for_moderation.siret')) $this->siret = data_get($this->user->values, 'for_moderation.siret');
		else $this->siret = $this->user->values->get('siret');

		if(data_get($this->user->values, 'for_moderation.company_name')) $this->companyName = data_get($this->user->values, 'for_moderation.company_name');
		else $this->companyName = $this->user->values->get('company_name');
	}

	public function render()
	{
		return view('livewire.front.space.profile.my-profile');
	}
}
