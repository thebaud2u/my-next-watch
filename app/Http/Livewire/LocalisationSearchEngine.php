<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\DB;

use App\Models\ { Country, Department, Region, City};

class LocalisationSearchEngine extends Component
{
	public $hideDistance = false;
	public $showResults = false;
	public $showDistance = false;
	public $valuesLoadedFromSession = false;
	public $from = '';
	public $search = '';
	public $searchLabel;
	public $locType = '';
	public $locId = '';
	public $records;
	public $filters;

	// Fetch records
	public function searchLocalisationEntry()
	{
		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = 0;

		if(!empty($this->search)) {
			$countries = Country::query()
				->select(DB::raw('"country" as type, 1 as priority, id, name, null as zip_code'))
				->whereRaw('REPLACE(name, "-", " ") LIKE ?', [str_replace('-', ' ', $this->search).'%'])
				->whereIn('code', ['BEL', 'FRA']);

			$regions = Region::query()
				->select(DB::raw('"region" as type, 2 as priority, id, name, null as zip_code'))
				->whereRaw('REPLACE(name, "-", " ") LIKE ?', [str_replace('-', ' ', $this->search).'%']);

			$departments = Department::query()
				->select(DB::raw('"department" as type, 3 as priority, id, name, null as zip_code'))
				->whereRaw('REPLACE(name, "-", " ") LIKE ?', [str_replace('-', ' ', $this->search).'%'])
				->when($this->search, function ($query, $value) {
					if(preg_match('`^[0-9]{2,3}$`', $value)) {
						return $query->orWhere('code', 'like', $value.'%');
					}
				});

			$cities = City::query()
				->select(DB::raw('"cities" as type, 4 as priority, department_code, name, count(id) as number_of_cities'))
				->whereRaw('REPLACE(name, "-", " ") LIKE ?', [str_replace('-', ' ', $this->search).'%'])
				->groupBy('department_code', 'name')
				->having('number_of_cities', '>', 1);

			$req = City::query()
				->select(DB::raw('"city" as type, 5 as priority, id, name, zip_code'))
				->whereRaw('REPLACE(name, "-", " ") LIKE ?', [str_replace('-', ' ', $this->search).'%'])
				->when($this->search, function ($query, $value) {
					if(preg_match('`^[0-9]{2,5}$`', $value)) {
						return $query->orWhere('zip_code', 'like', $value.'%');
					}
				})
				->union($countries)
				->union($regions)
				->union($departments)
				->union($cities)
				->orderBy('priority', 'asc')
				->orderBy('name', 'asc')
				->orderBy('zip_code', 'asc');

			if(strtolower($this->search) == 'paris' || $this->search == '75' || $this->search == '750') $req->limit(25);
			else $req->limit(15);

			$this->records = $req->get();

			$this->showResults = true;
		}
		else {
			$this->filters['country_id'] = null;
			$this->filters['region_id'] = null;
			$this->filters['department_id'] = null;
			$this->filters['city_id'] = null;
			$this->filters['cities'] = null;
			$this->filters['distance'] = 0;
			$this->showResults = false;
		}

		$this->showDistance = false;
	}

	// Fetch record by ID
	public function fetchDetail($selection)
	{
		switch ($selection['type']) {
			case 'country':
				$country = Country::select('*')
					->where('id', $selection['id'])
					->first();

				$this->filters['country_id'] = $country->id;
				$this->filters['region_id'] = null;
				$this->filters['department_id'] = null;
				$this->filters['city_id'] = null;
				$this->filters['cities'] = null;
				$this->filters['distance'] = 0;
				$this->search = $country->name;
				$this->searchLabel = $country->name.' ('.__('country').')';
				$this->locType = $selection['type'];
				$this->locId = $selection['id'];
				break;
			case 'region':
				$region = Region::select('*')
					->where('id', $selection['id'])
					->first();

				$country = Country::select('*')
					->where('code', $region->country_code)
					->first();

				$this->filters['country_id'] = $country->id;
				$this->filters['region_id'] = $region->id;
				$this->filters['department_id'] = null;
				$this->filters['city_id'] = null;
				$this->filters['cities'] = null;
				$this->filters['distance'] = 0;
				$this->search = $region->name;
				$this->searchLabel = $region->name.' ('.__('region').')';
				$this->locType = $selection['type'];
				$this->locId = $selection['id'];
				break;
			case 'department':
				$department = Department::select('*')
					->where('id', $selection['id'])
					->first();

				$region = Region::select('*')
					->where('code', $department->region_code)
					->first();

				$country = Country::select('*')
					->where('code', $region->country_code)
					->first();

				$this->filters['country_id'] = $country->id;
				$this->filters['region_id'] = $region->id;
				$this->filters['department_id'] = $department->id;
				$this->filters['city_id'] = null;
				$this->filters['cities'] = null;
				$this->filters['distance'] = 0;
				$this->search = $department->name;
				$this->searchLabel = $department->name.' ('.__('department').')';
				$this->locType = $selection['type'];
				$this->locId = $selection['id'];
				break;
			case 'city':
				$city = City::select('*')
					->where('id', $selection['id'])
					->first();

				$department = Department::select('*')
					->where('code', $city->department_code)
					->first();

				$region = Region::select('*')
					->where('code', $department->region_code)
					->first();

				$country = Country::select('*')
					->where('code', $region->country_code)
					->first();

				$this->filters['country_id'] = $country->id;
				$this->filters['region_id'] = $region->id;
				$this->filters['department_id'] = $department->id;
				$this->filters['city_id'] = $city->id;
				$this->filters['cities'] = null;
				$this->filters['distance'] = 0;
				$this->search = $city->name;
				$this->searchLabel = $city->name.' ('.$city->zip_code.')';
				$this->locType = $selection['type'];
				$this->locId = $selection['id'];
				break;
			case 'cities':
				$cities = City::select('id')
					->where('name', $selection['name'])
					->get();

				$city = City::select('*')
					->where('name', $selection['name'])
					->first();

				$department = Department::select('*')
					->where('code', $city->department_code)
					->first();

				$region = Region::select('*')
					->where('code', $department->region_code)
					->first();

				$country = Country::select('*')
					->where('code', $region->country_code)
					->first();

				$this->filters['country_id'] = $country->id;
				$this->filters['region_id'] = $region->id;
				$this->filters['department_id'] = $department->id;
				$this->filters['city_id'] = null;
				$this->filters['cities'] = $cities->pluck('id');
				$this->filters['distance'] = 0;
				$this->search = $selection['name'];
				$this->searchLabel = $selection['name'].' ('.__('all city').')';
				$this->locType = $selection['type'];
				$this->locId = $cities->pluck('id');
				break;
			default:
				break;
		}

		$this->showResults = false;
		$this->showDistance = $this->hideDistance ? false : (!empty($this->filters['city_id']) || !empty($this->filters['cities']));
		$this->dispatch('location-choosen', filters: $this->filters,  from: $this->from);
		$this->dispatch('location-selected', filters: $this->filters, showDistance: $this->showDistance);
	}

	public function distanceUpdated()
	{
		$this->dispatch('location-selected', filters: $this->filters, showDistance: $this->showDistance);
	}

	#[On('location-reset')]
	public function locationReset()
	{
		$this->search = '';
		$this->searchLabel = '';
		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = 0;
	}

	public function mount()
	{
		$this->searchLabel = '';
		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = 0;

		if(!empty($locType) && in_array($locType, ['city', 'cities'])) {
			$this->filters['distance'] = (!empty($distance) && $distance < 200001 && ($distance % 20000) == 0) ? $distance / 1000 : 0;
			$this->showDistance = $this->hideDistance ? false : true;
		}

		if(request()->get('city')) {
			if($city = City::where('slug', request()->get('city'))->first()) $this->filters['city_id'] = $city->id;
		}

		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['country_id'])) $this->filters['country_id'] = $filters['country_id'];
			if(!empty($filters['region_id'])) $this->filters['region_id'] = $filters['region_id'];
			if(!empty($filters['department_id'])) $this->filters['department_id'] = $filters['department_id'];
			if(!empty($filters['city_id'])) $this->filters['city_id'] = $filters['city_id'];
			if(!empty($filters['cities'])) $this->filters['cities'] = $filters['cities'];
			if(!empty($filters['distance'])) $this->filters['distance'] = $filters['distance'];

			$this->valuesLoadedFromSession = true;
		}

		if($this->filters['cities']) {
			$cities = City::whereIn('id', $this->filters['cities'])
				->get();

			$this->searchLabel = $cities[0]->name.' ('.__('all city').')';
		}
		elseif($this->filters['city_id']) {
			$city = City::find($this->filters['city_id']);

			$this->searchLabel = $city->name.' ('.$city->zip_code.')';
		}
		elseif($this->filters['department_id']) {
			$department = Department::find($this->filters['department_id']);

			$this->searchLabel = $department->name.' ('.__('department').')';
		}
		elseif($this->filters['region_id']) {
			$region = Region::find($this->filters['region_id']);

			$this->searchLabel = $region->name.' ('.__('region').')';
		}
		elseif($this->filters['country_id']) {
			$country = Country::find($this->filters['country_id']);

			$this->searchLabel = $country->name.' ('.__('country').')';
		}
	}

	public function render()
	{
		if($this->valuesLoadedFromSession) $this->dispatch('search-label-set');

		return view('livewire.localisation-search-engine');
	}
}
