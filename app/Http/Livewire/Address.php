<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Carbon\Carbon;

use Illuminate\Support\Facades\Cache;

use App\Models\Address as ModelsAddress;
use App\Models\City;
use App\Models\Country;

class Address extends Component
{
	public $address;
	public $hideField;

	public $countries;
	public $regions;
	public $departments;

	public $showdiv = false;
	public $search = '';
	public $cities;
	public $city_required = false;
	public $country_required = false;
	public $additionnal_2 = true;
	public $disabled = false;
	public $dispatchName = 'address-selected';

	private $expire;

	public $rules = [
		'address.country_id' => [],
		'address.region_id' => [],
		'address.department_id' => [],
		'address.city_id' => [],
		'address.street' => [],
		'address.additional_1' => [],
		'address.additional_2' => [],
		'address.custom_postcode' => [],
		'address.custom_province' => [],
		'address.custom_city' => []
	];

	public function mount($address)
	{
		$this->address = new ModelsAddress();

		if (is_null($address)) {
			$this->address->country_id = Country::where('name', '=', 'France')->first()->id;
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
			$this->address->country_id = $address['country_id'];
			$this->address->region_id = $address['region_id'];
			$this->address->department_id = $address['department_id'];
			$this->address->city_id = $address['city_id'];
			$this->address->street = $address['street'];
			$this->address->additional_1 = $address['additional_1'];
			$this->address->additional_2 = $address['additional_2'];
			$this->address->custom_postcode = $address['custom_postcode'];
			$this->address->custom_province = $address['custom_province'];
			$this->address->custom_city = $address['custom_city'];
		}

		$this->expire = Carbon::now()->addDay(7);

		$this->countries = Cache::remember('countries', $this->expire, function() {
			return Country::all();
		});
	}

	public function searchResult()
	{
		if(!empty($this->search)){
			if (strtolower($this->search) == 'paris' || $this->search == '75' || $this->search == '750') {
				$this->cities = City::select('id', 'name', 'zip_code')
					->where('name', 'like', 'Paris%')
					->orderBy('name', 'ASC')
					->orderBy('zip_code', 'ASC')
					->limit(20)
					->get();
			}
			else {
				$this->cities = City::select('id', 'name', 'zip_code')
					->where('name', 'like', $this->search.'%')
					->orWhere('zip_code', 'like', $this->search.'%')
					->orderBy('name', 'ASC')
					->limit(10)
					->get();
			}

			$this->showdiv = true;
		}
		else $this->showdiv = false;
	}

	public function fetchDetail($selection)
	{
		$this->address->city = City::find($selection['id']);
		$this->address->city_id = $this->address->city->id;
		$this->address->department = $this->address->city->department;
		$this->address->department_id = $this->address->department->id;
		$this->address->region = $this->address->department->region;
		$this->address->region_id = $this->address->region->id;
		$this->search = $this->address->city->name;

		$this->address->custom_postcode = null;
		$this->address->custom_province = null;
		$this->address->custom_city = null;

		$this->showdiv = false;
	}

	public function updatedAddressCountryId()
	{
		if($this->address->country_id !== 67) {
			$this->address->department_id = null;
			$this->address->region_id = null;
			$this->address->city_id = null;
		}
	}

	public function render()
	{
		$this->dispatch($this->dispatchName, $this->address);

		return view('livewire.address');
	}
}
