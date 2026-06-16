<?php

namespace App\Http\Livewire\Front\Companies;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use App\Enums\PostTypesAvailable;
use App\Enums\PublicationStates;

use App\Models\{Company, City, Search};

class Index extends Component
{
	use WithPagination;

	public $filters;

	#[On('companies-filters')]
	public function search(array $filters)
	{
		$this->filters['company_keyword'] = $filters['company_keyword'];
		$this->filters['company_country_id'] = $filters['company_country_id'];
		$this->filters['company_region_id'] = $filters['company_region_id'];
		$this->filters['company_department_id'] = $filters['company_department_id'];
		$this->filters['company_city_id'] = $filters['company_city_id'];
		$this->filters['company_cities'] = $filters['company_cities'];
		$this->filters['company_distance'] = $filters['company_distance'];
		$this->filters['company_breed'] = $filters['company_breed'];
	}

	#[On('companies-advanced-filters')]
	public function advancedSearch($filters)
	{
		$this->filters['company_post_type_available'] = $filters['company_post_type_available'];
		$this->filters['company_order_by'] = $filters['company_order_by'];
	}

	public function mount()
	{
		// Filters
		$this->filters['company_keyword'] = null;
		$this->filters['company_country_id'] = null;
		$this->filters['company_region_id'] = null;
		$this->filters['company_department_id'] = null;
		$this->filters['company_city_id'] = null;
		$this->filters['company_cities'] = null;
		$this->filters['company_cities_lat'] = null;
		$this->filters['company_cities_lng'] = null;
		$this->filters['company_distance'] = 0;

		// Advanced search filters
		$this->filters['company_post_type_available'] = [];
		$this->filters['company_order_by'] = 'revelancy';

		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['company_company_keyword'])) $this->filters['company_keyword'] = $filters['company_keyword'];
			if(!empty($filters['company_country_id'])) $this->filters['company_country_id'] = $filters['company_country_id'];
			if(!empty($filters['company_region_id'])) $this->filters['company_region_id'] = $filters['company_region_id'];
			if(!empty($filters['company_department_id'])) $this->filters['company_department_id'] = $filters['company_department_id'];
			if(!empty($filters['company_city_id'])) $this->filters['company_city_id'] = $filters['company_city_id'];
			if(!empty($filters['company_cities'])) $this->filters['company_cities'] = $filters['company_cities'];
			if(!empty($filters['company_distance'])) $this->filters['company_distance'] = $filters['company_distance'];

			if(!empty($filters['company_post_type_available'])) $this->filters['company_post_type_available'] = $filters['company_post_type_available'];
			if(!empty($filters['company_order_by'])) $this->filters['company_order_by'] = $filters['company_order_by'];
		}
	}

	public function render()
	{
		// Defining longitude and latitude
		if(!is_null($this->filters['company_cities'])) {
			$cities = City::whereIn('id', $this->filters['company_cities'])->get();

			if($cities->isNotEmpty()) {
				$lat = $cities->pluck('gps_lat')->toArray();
				$lng = $cities->pluck('gps_lng')->toArray();

				$this->filters['company_cities_lat'] = round(array_sum($lat) / count($lat), 10);
				$this->filters['company_cities_lng'] = round(array_sum($lng) / count($lng), 10);
			}
		}
		else {
			$this->filters['company_cities_lat'] = null;
			$this->filters['company_cities_lng'] = null;
		}

		// Defining cities in the distance circle
		$cityIdsInRadius = null;
		if($this->filters['company_distance'] > 0) {
			$cityId = $this->filters['company_cities'][0] ?? $this->filters['company_city_id'] ?? null;

			if($cityId) {
				$city = City::find($cityId);

				if($city) {
					$cityIdsInRadius = City::select('id')
						->whereRaw(
							'ST_Distance_Sphere(point(gps_lng, gps_lat), point(?, ?)) <= ?',
							[$city->gps_lng, $city->gps_lat, $this->filters['company_distance'] * 1000]
						)->pluck('id')->toArray();
				}
			}
		}

		$addressFilter = function($filter) use($cityIdsInRadius) {
			if(!empty($this->filters['company_country_id']) && $this->filters['company_distance'] == 0) $filter->where('country_id', $this->filters['company_country_id']);
			if(!empty($this->filters['company_region_id']) && $this->filters['company_distance'] == 0) $filter->where('region_id', $this->filters['company_region_id']);
			if(!empty($this->filters['company_department_id']) && $this->filters['company_distance'] == 0) $filter->where('department_id', $this->filters['company_department_id']);
			if(!empty($cityIdsInRadius)) $filter->whereIn('city_id', $cityIdsInRadius);
			elseif(!empty($this->filters['company_cities']) && $this->filters['company_distance'] == 0) $filter->whereIn('city_id', $this->filters['company_cities']);
			elseif(!empty($this->filters['company_city_id']) && $this->filters['company_distance'] == 0) $filter->where('city_id', $this->filters['company_city_id']);
		};

		$companies = Company::whereHas('user')
			->whereHas('lastPublication', function($whereHasPublication) {
				$whereHasPublication->whereIn('state', [
					PublicationStates::Published,
					PublicationStates::PublishedUpdatedWaitingModeration,
					PublicationStates::PublishedUpgradedWaitingModeration
				]);
			})
			->when($this->filters['company_post_type_available'], function($when) {
				$when->whereHas('user', function($whereHasUser) {
					$whereHasUser->whereHas('posts', function($whereHasPosts) {
						$whereHasPosts->whereHas('type', function($whereHasType) {
							$whereHasType->where(function($where) {
								if(in_array(PostTypesAvailable::LittersAvailable->value, $this->filters['company_post_type_available'])) {
									$where->orWhere('slug->en', 'litter');
								}
							});

						})
						->whereHas('lastPublication', function($whereHasPublication) {
							$whereHasPublication->whereIn('state', [
								PublicationStates::Published,
								PublicationStates::PublishedUpdatedWaitingModeration,
								PublicationStates::PublishedUpgradedWaitingModeration
							]);
						});
					});
				});
			})
			->when($this->filters['company_keyword'], function($when) {
				$when->where(function($where) {
					$where->where('name', 'LIKE', '%'.$this->filters['company_keyword'].'%')
						->orWhere('slug', 'LIKE', '%'.$this->filters['company_keyword'].'%')
						->orWhere('description', 'LIKE', '%'.$this->filters['company_keyword'].'%')
						->orWhereHas('address', function($whereHasAddress) {
							$whereHasAddress->where('street', 'LIKE', '%'.$this->filters['company_keyword'].'%')
								->orWhere('custom_city', 'LIKE', '%'.$this->filters['company_keyword'].'%')
								->orWhere('custom_province', 'LIKE', '%'.$this->filters['company_keyword'].'%')
								->orWhere('custom_postcode', 'LIKE', '%'.$this->filters['company_keyword'].'%')
								->orWhereHas('city', function($whereHasCity) {
									$whereHasCity->where('zip_code', 'LIKE', '%'.$this->filters['company_keyword'].'%')
										->orWhere('name', 'LIKE', '%'.$this->filters['company_keyword'].'%');
								})
								->orWhereHas('country', function($whereHasCountry) {
									$whereHasCountry->where('name', 'LIKE', '%'.$this->filters['company_keyword'].'%');
								})
								->orWhereHas('department', function($whereHasDepartment) {
									$whereHasDepartment->where('name', 'LIKE', '%'.$this->filters['company_keyword'].'%');
								})
								->orWhereHas('region', function($whereHasRegion) {
									$whereHasRegion->where('name', 'LIKE', '%'.$this->filters['company_keyword'].'%');
								});
						});
					});
			})
			->when($this->filters['company_order_by'], function($when) {
				if($this->filters['company_order_by'] == 'publication') {
					$when->orderByDesc('created_at')
						->orderByDesc('updated_at')
						->orderByDesc('id');
				}
				else {
					$when->orderByDesc('refreshed_at')
						->orderByDesc('created_at')
						->orderByDesc('updated_at')
						->orderByDesc('id');
				}
			})
			->whereHas('address', $addressFilter)
			->paginate(30);

		foreach($companies as $company) {
			views($company)
				->collection('search')
				->record();
		}

		// if(session()->has('filters')) session()->forget('filters');

		$this->dispatch('set-company-count', $companies->total());

		return view('livewire.front.companies.index', [
			'companies' => $companies,
		]);
	}
}
