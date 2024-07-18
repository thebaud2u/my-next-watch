<?php

namespace App\Http\Livewire\Front\Space\Account;

use Livewire\Component;
use Livewire\Attributes\On;

use Auth;

use App\Models\Activity;
use App\Models\Gender;
use App\Models\Thematic;
use App\Models\Sector;
use App\Models\User;

class Slot extends Component
{
	public User $user;

	public $active = 'account';
	public $address;

	// Lists
	public $activities;
	public $genders;
	public $thematics;
	public $sectors;

	protected function rules()
	{
		return [
			'user.gender_id' => [],
			'user.first_name' => [],
			'user.last_name' => [],
			'user.mobile_phone' => [],
			'user.thematic_id' => [],
			'user.type' => [],
			'user.birth_date' => [],
			'user.sector_id' => [],
			'user.activity_id' => [],
			'user.values.raison_sociale' => [],
			'user.values.company_name' => [],
			'user.values.naf' => [],
			'user.values.siret' => [],
			'user.values.tva' => [],
			'user.values.company_phone' => [],
			'user.values.url' => [],
			'user.values.facebook' => [],
			'user.values.linkedin' => [],
			'user.values.instagram' => [],
			'user.values.company_presentation' => []
		];
	}

	public function slotChange()
	{
		$this->dispatch('slot-change', active: $this->active);
	}

	#[On('side-menu-change')]
	public function sideMenuChange($active)
	{
		$this->active = $active;
	}

	#[On('address-selected')]
	public function addressSelected($address)
	{
		$this->address = $address;
	}

	public function thematicSelected()
	{
		$this->user->load('thematic');

		if($this->user->thematic) {
			$this->sectors = Sector::whereHas('thematic', function($whereHas) {
					$whereHas->where('id', $this->user->thematic->id);
				})
				->orderBy('name', 'ASC')
				->get();
		}
	}

	public function sectorSelected()
	{
		$this->user->load('sector');

		if($this->user->sector) {
			$this->activities = Activity::whereHas('sector', function($whereHas) {
					$whereHas->where('id', $this->user->sector->id);
				})
				->orderBy('name', 'ASC')
				->get();
		}
	}

	public function typeChanged()
	{
		if($this->user->type == 'Professionnel') $this->thematicSelected();
	}

	public function submitForm()
	{
		if($this->active == 'account') {
			$rules = [
				'user.first_name' => ['required'],
				'user.last_name' => ['required'],
				'user.birth_date' => ['nullable', 'date'],
				'user.mobile_phone' => ['required', 'digits:10'],
				'user.gender_id' => ['required']
			];

			$messages = [
				'user.first_name.required' => 'Votre prénom est obligatoire',
				'user.last_name.required' => 'Votre nom est obligatoire',
				'user.birth_date.date' => 'Une date est attendue',
				'user.mobile_phone.required' => 'Votre numéro de téléphone portable est obligatoire',
				'user.mobile_phone.digits' => 'Votre numéro de téléphone portable doit être composé de 10 chiffres',
				'user.gender_id.required' => 'Votre civilité est obligatoire'
			];

			$this->validate($rules, $messages);

			$this->user->last_name = ucwords($this->user->last_name, " -'");
			$this->user->first_name = ucwords($this->user->first_name, " -'");
			$this->user->name = ucwords($this->user->first_name.' '.$this->user->last_name, " -'");
			$this->user->save();

			$this->active = 'profile';
			$this->slotChange($this->active);

			session()->flash('success', __('Account\'s change saved successfully'));
		}
		else {
			$rules = [
				'user.type' => ['required']
			];

			$messages = [
				'user.type.required' => 'Êtes-vous un particulier ou un professionnel ?'
			];

			if($this->user->type == 'Professionnel') {
				$rules['user.values.raison_sociale'] = ['required'];
				$rules['user.values.company_name'] = ['required'];
				$rules['user.values.naf'] = ['required', 'min:5', 'max:5'];
				$rules['user.values.siret'] = ['required', 'max:14'];
				$rules['user.values.company_phone'] = ['required'];
				$rules['user.values.company_presentation'] = ['max:800'];

				$messages['user.values.raison_sociale.required'] = 'Veuillez préciser la raison sociale de votre entreprise';
				$messages['user.values.company_name.required'] = 'Veuillez préciser le nom de votre entreprise';
				$messages['user.values.naf.required'] = 'Veuillez préciser le code NAF de votre entreprise';
				$messages['user.values.naf.min'] = 'Le code NAF compte 5 caractères';
				$messages['user.values.naf.max'] = 'Le code NAF compte 5 caractères';
				$messages['user.values.siret.required'] = 'Veuillez préciser le SIRET de votre entreprise';
				$messages['user.values.siret.max'] = 'Le SIRET se compose de 14 caractères';
				$messages['user.values.company_phone.required'] = 'Veuillez préciser le numéro de téléphone de votre entreprise';
				$messages['user.values.company_presentation.max:800'] = '800 caractères maximum';
			}

			if(is_null($this->address)) {
				$rules['address.city_id'] = ['required'];
				$rules['address.country_id'] = ['required'];
				$messages['address.city_id.required'] = 'La ville est obligatoire';
				$messages['address.country_id.required'] = 'Le pays est obligatoire';
			}
			else {
				if(is_null($this->address['country_id'])) {
					$rules['address.city_id'] = ['required'];
					$rules['address.country_id'] = ['required'];
					$messages['address.city_id.required'] = 'La ville est obligatoire';
					$messages['address.country_id.required'] = 'Le pays est obligatoire';
				}
				elseif($this->address['country_id'] == 67 && is_null($this->address['city_id'])) {
					$rules['address.city_id'] = ['required'];
					$messages['address.city_id.required'] = 'La ville est obligatoire';
				}
				elseif($this->address['country_id'] != 67 && is_null($this->address['custom_city'])) {
					$rules['address.custom_city'] = ['required'];
					$messages['address.custom_city.required'] = 'La ville est obligatoire';
				}
			}

			$this->validate($rules, $messages);

			if(!$this->user->address) $this->user->address()->create($this->address);
			else {
				$this->user->address->update([
					'street' => $this->address['street'],
					'additional_1' => $this->address['additional_1'],
					'additional_2' => $this->address['additional_2'],
					'custom_postcode' => $this->address['custom_postcode'],
					'custom_province' => $this->address['custom_province'],
					'custom_city' => $this->address['custom_city'],
					'region_id' => $this->address['region_id'],
					'department_id' => $this->address['department_id'],
					'city_id' => $this->address['city_id'],
					'country_id' => $this->address['country_id']
				]);
			}

			$this->user->save();

			session()->flash('success', __('Profile\'s change saved successfully'));
		}
	}

	public function mount($active)
	{
		$this->active = $active;
		$this->user = Auth::guard('web')->user();

		if(empty($this->user->values)) {
			$this->user->values = [
				'raison_sociale' => null,
				'company_name' => null,
				'naf' => null,
				'siret' => null,
				'tva' => null,
				'company_phone' => null,
				'url' => null,
				'facebook' => null,
				'linkedin' => null,
				'instagram' => null,
				'company_presentation' => null
			];

			$this->user->save();
		}

		$this->address = $this->user->address()->first();

		// Lists
		$this->genders = Gender::all();
		$this->thematics = Thematic::all();

		if($this->user->type == 'Professionnel') {
			$this->thematicSelected();
			$this->sectorSelected();
		}
	}

	public function render()
	{
		return view('livewire.front.space.account.slot');
	}
}
