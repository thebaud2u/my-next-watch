<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Cache;

use App\Models\{Address as ModelsAddress, City, Country, Department, Region};

class Address extends Component
{
	public $address;
	public $hideField;

	public $countries;
	public $regions;
	public $departments;

	public $showDivCity = false;
	public $showDivZipCode = false;
	public $search = '';
	public $cities;
	public $zipCode;
	public $streetRequired = false;
	public $zipCodeRequired = false;
	public $cityRequired = false;
	public $countryRequired = false;
	public $showZipCode = false;
	public $showCountry = true;
	public $additionnal_1 = true;
	public $additionnal_2 = true;
	public $disabled = false;
	public $dispatchName = 'address-selected';

	private $expire;

	public $rules = [
		'address.country_id' => [],
		'address.region_id' => [],
		'address.department_id' => [],
		'address.city_id' => [],
		'zipCode' => [],
		'address.street' => [],
		'address.additional_1' => [],
		'address.additional_2' => [],
		'address.custom_postcode' => [],
		'address.custom_province' => [],
		'address.custom_city' => []
	];

	#[On('address-validation-error')]
	public function validationError()
	{
		if($this->address->country_id == 19) {
			$rules = [
				'address.street' => ['required'],
				'address.custom_city' => ['required'],
				'address.custom_postcode' => ['required']
			];

			$messages = [
				'address.street.required' => __(':element is mandatory', ['element' => __('Your street')]),
				'address.custom_city.required' => __(':element is mandatory', ['element' => __('Your city')]),
				'address.custom_postcode.required' => __(':element is mandatory', ['element' => __('Your postal code')]),
			];
		}
		elseif($this->address->country_id == 67) {
			$rules = [
				'address.street' => ['required'],
				'address.city_id' => ['required'],
				'zipCode' => ['required']
			];

			$messages = [
				'address.street.required' => __(':element is mandatory', ['element' => __('Your street')]),
				'address.city_id.required' => __(':element is mandatory', ['element' => __('Your city')]),
				'zipCode.required' => __(':element is mandatory', ['element' => __('Your postal code')])
			];
		}

		$this->validate($rules, $messages);
		$this->dispatch('address-validation-ok');
	}

	public function searchZipCode()
	{
		if(!empty($this->zipCode)) {
			$this->cities = City::where('zip_code', 'like', '%'.$this->zipCode.'%')
				->orderBy('name', 'ASC')
				->get();

			$this->showDivZipCode = true;
			$this->showDivCity = false;
		}
		else $this->showDivZipCode = false;
	}

	public function searchCity()
	{
		if(!empty($this->search)) {
			$this->cities = City::where('name', 'like', '%'.$this->search.'%')
				->orWhere('zip_code', 'like', '%'.$this->search.'%')
				->orderBy('name', 'ASC')
				->get();

			$this->showDivCity = true;
			$this->showDivZipCode = false;
		}
		else $this->showDivCity = false;
	}

	public function fetchDetail($cityId)
	{
		$this->address->city_id = $cityId;
		$this->address->load('city');

		$this->address->department_id = $this->address->city->department->id;
		$this->address->load('department');

		$this->address->region_id = $this->address->department->region->id;
		$this->address->load('region');

		$this->address->country_id = $this->address->region->country->id;
		$this->address->load('country');

		$this->search = $this->address->city->name;
		$this->zipCode = $this->address->city->zip_code;

		$this->showDivCity = false;
		$this->showDivZipCode = false;
	}

	public function countrySelected()
	{
		$this->address->region_id = null;
		$this->address->department_id = null;
		$this->address->city_id = null;
		$this->address->street = null;
		$this->address->additional_1 = null;
		$this->address->additional_2 = null;
		$this->address->custom_postcode = null;
		$this->address->custom_province = null;
		$this->address->custom_city = null;
	}

	public function mount($address)
	{
		$this->address = $address;

		if(is_null($this->address->id)) {
			$this->address->country_id = Country::where('code', 'FRA')->first()->id;
			$this->address->region_id = null;
			$this->address->department_id = null;
			$this->address->city_id = null;
			$this->address->street = null;
			$this->address->additional_1 = null;
			$this->address->additional_2 = null;
			$this->address->custom_postcode = null;
			$this->address->custom_province = null;
			$this->address->custom_city = null;
		}
		else {
			if($this->address->city) {
				$this->zipCode = $this->address->city->zip_code;
				$this->search = $this->address->city->name;
			}
		}

		/*$this->expire = Carbon::now()->addDay(7);

		$this->countries = Cache::remember('countries', $this->expire, function() {
			return Country::all();
		});*/
		$this->countries = Country::whereIn('slug', ['belgique', 'france'])
			->get();
	}

	public function render()
	{
		$this->dispatch($this->dispatchName, $this->address);

		return view('livewire.address');
	}
}
