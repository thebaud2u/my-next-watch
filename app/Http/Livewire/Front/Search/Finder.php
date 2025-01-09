<?php

namespace App\Http\Livewire\Front\Search;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Brand;
use App\Models\Bracelet;
use App\Models\Case;
use App\Models\Movement;
use App\Models\Watch;

class Index extends Component
{
	use WithPagination;

	public $filters;
	public PostType $postType;
	public Thematic $thematic;
	public $thematicHome;

	#[On('posts-search')]
	public function search(array $filters)
	{
		$this->filters['keyword'] = $filters['keyword'];
		$this->filters['country_id'] = $filters['country_id'];
		$this->filters['region_id'] = $filters['region_id'];
		$this->filters['department_id'] = $filters['department_id'];
		$this->filters['city_id'] = $filters['city_id'];
		$this->filters['cities'] = $filters['cities'];
		$this->filters['distance'] = $filters['distance'];
		$this->filters['post_type_id'] = $filters['post_type_id'];
		$this->filters['good_type_id'] = $filters['good_type_id'];
		$this->filters['starting_points'] = $filters['starting_points'];
		$this->filters['destinations'] = $filters['destinations'];
	}

	#[On('posts-advanced-search')]
	public function advancedSearch($filters)
	{
		if($this->thematic->slug == 'transport') {
			$this->filters['order_by'] = $filters['order_by'];
			$this->filters['activity_types'] = $filters['activity_types'];
			$this->filters['availability_max'] = $filters['availability_max'];
			$this->filters['availability_min'] = $filters['availability_min'];
			$this->filters['characteristics'] = $filters['characteristics'];
			$this->filters['closing_date'] = $filters['closing_date'];
			$this->filters['commissioning_year_max'] = $filters['commissioning_year_max'];
			$this->filters['commissioning_year_min'] = $filters['commissioning_year_min'];
			$this->filters['energy_classes'] = $filters['energy_classes'];
			$this->filters['ges'] = $filters['ges'];
			$this->filters['good_types'] = $filters['good_types'];
			$this->filters['market_spectrums'] = $filters['market_spectrums'];
			$this->filters['market_types'] = $filters['market_types'];
			$this->filters['mileage_max'] = $filters['mileage_max'];
			$this->filters['mileage_min'] = $filters['mileage_min'];
			$this->filters['notice_types'] = $filters['notice_types'];
			$this->filters['price_max'] = $filters['price_max'];
			$this->filters['price_min'] = $filters['price_min'];
			$this->filters['sectors'] = $filters['sectors'];
			$this->filters['surface_max'] = $filters['surface_max'];
			$this->filters['surface_min'] = $filters['surface_min'];
			$this->filters['tractor_types'] = $filters['tractor_types'];
			$this->filters['vehicule_types'] = $filters['vehicule_types'];
		}
		elseif($this->thematic->slug == 'social') {
			$this->filters['notice_types'] = $filters['notice_types'];
			$this->filters['closing_date_max'] = $filters['closing_date_max'];
			$this->filters['closing_date_min'] = $filters['closing_date_min'];
		}
	}

	public function mount()
	{
		// Search filters
		$this->filters['keyword'] = null;

		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['cities_lat'] = null;
		$this->filters['cities_lng'] = null;
		$this->filters['distance'] = 0;
		$this->filters['post_type_id'] = null;
		$this->filters['good_type_id'] = null;
		$this->filters['starting_points'] = [];
		$this->filters['destinations'] = [];

		if($this->postType->id) $this->filters['post_type_id'] = $this->postType->id;

		// Advanced search filters
		$this->filters['order_by'] = 'revelancy';

		$this->filters['activity_types'] = [];
		$this->filters['availability_max'] = null;
		$this->filters['availability_min'] = null;
		$this->filters['characteristics'] = [];
		$this->filters['closing_date'] = null;
		$this->filters['commissioning_year_max'] = null;
		$this->filters['commissioning_year_min'] = null;
		$this->filters['energy_classes'] = [];
		$this->filters['ges'] = [];
		$this->filters['good_types'] = [];
		$this->filters['market_spectrums'] = [];
		$this->filters['market_types'] = [];
		$this->filters['mileage_max'] = null;
		$this->filters['mileage_min'] = null;
		$this->filters['notice_types'] = [];
		$this->filters['price_max'] = null;
		$this->filters['price_min'] = null;
		$this->filters['sectors'] = [];
		$this->filters['surface_max'] = null;
		$this->filters['surface_min'] = null;
		$this->filters['tractor_types'] = [];
		$this->filters['vehicule_types'] = [];
		$this->filters['notice_types'] = [];
		$this->filters['closing_date_max'] = null;
		$this->filters['closing_date_min'] = null;

		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['keyword'])) $this->filters['keyword'] = $filters['keyword'];
			if(!empty($filters['country_id'])) $this->filters['country_id'] = $filters['country_id'];
			if(!empty($filters['region_id'])) $this->filters['region_id'] = $filters['region_id'];
			if(!empty($filters['department_id'])) $this->filters['department_id'] = $filters['department_id'];
			if(!empty($filters['city_id'])) $this->filters['city_id'] = $filters['city_id'];
			if(!empty($filters['cities'])) $this->filters['cities'] = $filters['cities'];
			if(!empty($filters['distance'])) $this->filters['distance'] = $filters['distance'];
			if(!empty($filters['post_type_id'])) $this->filters['post_type_id'] = $filters['post_type_id'];
			if(!empty($filters['good_type_id'])) $this->filters['good_type_id'] = $filters['good_type_id'];
			if(!empty($filters['starting_points'])) $this->filters['starting_points'] = $filters['starting_points'];
			if(!empty($filters['destinations'])) $this->filters['destinations'] = $filters['destinations'];
		}
	}

	public function render()
	{
		if($this->thematic->slug != 'maritime') {
			if(!is_null($this->filters['cities'])) {
				$cities = City::whereIn('id', $this->filters['cities'])
					->get();

				if ($cities->isNotEmpty()) {
					$lat = $cities->pluck('gps_lat')->toArray();
					$lng = $cities->pluck('gps_lng')->toArray();

					$this->filters['cities_lat'] = round(array_sum($lat) / count($lat), 10);
					$this->filters['cities_lng'] = round(array_sum($lng) / count($lng), 10);
				}
			}
			else {
				$this->filters['cities_lat'] = null;
				$this->filters['cities_lng'] = null;
			}
		}

		$posts = Post::when($this->filters['keyword'], function($when) {
				$when->where(function($where) {
					$where->where('title', 'like', '%'.$this->filters['keyword'].'%')
						->orWhere('body', 'like', '%'.$this->filters['keyword'].'%')
						->orWhere('id', '=', $this->filters['keyword']);
				});
			});

		if($this->thematic->slug != 'maritime') {
			$posts = $posts->whereHas('addresses', function($whereHas) {
				$whereHas->when($this->filters['country_id'], function($when) {
						if($this->filters['distance'] == 0) $when->where('country_id', $this->filters['country_id']);
					}, function($default) {
						$default->where('country_id', 67);
					})
					->when($this->filters['region_id'], function($when) {
						if($this->filters['distance'] == 0) $when->where('region_id', $this->filters['region_id']);
					})
					->when($this->filters['department_id'], function($when) {
						if($this->filters['distance'] == 0) $when->where('department_id', $this->filters['department_id']);
					})
					->when($this->filters['cities'], function($when) {
						if (empty($this->filters['distance'])) $when->whereIn('city_id', $this->filters['cities']);
						else {
							$city = City::find($this->filters['cities'][0]);

							$cities = City::select('id')
								->whereRaw(
									'(ST_Distance_Sphere(point(gps_lng, gps_lat), point(?, ?))) <= ? ',
									[$city->gps_lng, $city->gps_lat, $this->filters['distance'] * 1000]
								)
								->pluck('id');

							$when->whereIn('city_id', $cities);
						}
					})
					->when($this->filters['city_id'], function($when) {
						if (empty($this->filters['distance'])) $when->where('city_id', $this->filters['city_id']);
						else {
							$city = City::find($this->filters['city_id']);

							$cities = City::select('id')
								->whereRaw(
									'(ST_Distance_Sphere(point(gps_lng, gps_lat), point(?, ?))) <= ? ',
									[$city->gps_lng, $city->gps_lat, $this->filters['distance'] * 1000]
								)
								->pluck('id');

							$when->whereIn('city_id', $cities);
						}
					});
			});
		}

		if($this->thematic->id) {
			$posts = $posts->whereHas('thematic', function($whereHas) {
					$whereHas->where('id', $this->thematic->id);
				});
		}

		$posts = $posts->whereHas('postType', function($whereHas) {
				$whereHas->when($this->filters['post_type_id'], function ($when) {
					$when->where('id', $this->filters['post_type_id']);
				});
			});

		if($this->thematic->slug == 'social') {
			$posts = $posts->where(function($where) {
				$where->when($this->filters['notice_types'], function($whenFilter) {
					foreach($this->filters['notice_types'] as $filterNoticeType) {
						$whenFilter->orWhereJsonContains('values_web->notice_type', $filterNoticeType);
					}
				})
				->when($this->filters['closing_date_max'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.closing_date") AS UNSIGNED) <= ?', $this->filters['closing_date_max']);
				})
				->when($this->filters['closing_date_min'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.closing_date") AS UNSIGNED) >= ?', $this->filters['closing_date_min']);
				});
			});
		}

		if($this->thematic->slug == 'transport') {
			$posts = $posts->where(function($where) {
				$where->when($this->filters['activity_types'], function($whenFilter) {
					foreach($this->filters['activity_types'] as $filterActivityType) {
						$whenFilter->orWhereJsonContains('values_web->activity_type', $filterActivityType);
					}
				})
				->when($this->filters['characteristics'], function($whenFilter) {
					foreach($this->filters['characteristics'] as $filterCharacteristic) {
						$whenFilter->orWhereJsonContains('values_web->characteristics', $filterCharacteristic);
					}
				})
				->when($this->filters['closing_date'], function($whenFilter) {
					$whenFilter->whereJsonContains('values_web->closing_date', $this->filters['closing_date']);
				})
				->when($this->filters['commissioning_year_max'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.commissioning_year") AS UNSIGNED) <= ?', $this->filters['commissioning_year_max']);
				})
				->when($this->filters['commissioning_year_min'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.commissioning_year") AS UNSIGNED) >= ?', $this->filters['commissioning_year_min']);
				})
				->when($this->filters['energy_classes'], function($whenFilter) {
					foreach($this->filters['energy_classes'] as $filterEnergyClass) {
						$whenFilter->orWhereJsonContains('values_web->energy_class', $filterEnergyClass);
					}
				})
				->when($this->filters['ges'], function($whenFilter) {
					foreach($this->filters['ges'] as $filterGES) {
						$whenFilter->orWhereJsonContains('values_web->ges', $filterGES);
					}
				})
				->when($this->filters['good_types'], function($whenFilter) {
					foreach($this->filters['good_types'] as $filterGoodType) {
						$whenFilter->orWhereJsonContains('values_web->good_types', $filterGoodType);
					}
				})
				->when($this->filters['market_spectrums'], function($whenFilter) {
					foreach($this->filters['market_spectrums'] as $filterMarketSpectrum) {
						$whenFilter->orWhereJsonContains('values_web->market_spectrum', $filterMarketSpectrum);
					}
				})
				->when($this->filters['market_types'], function($whenFilter) {
					foreach($this->filters['market_types'] as $filterMarketType) {
						$whenFilter->orWhereJsonContains('values_web->market_type', $filterMarketType);
					}
				})
				->when($this->filters['mileage_max'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.mileage") AS UNSIGNED) <= ?', $this->filters['mileage_max']);
				})
				->when($this->filters['mileage_min'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.mileage") AS UNSIGNED) >= ?', $this->filters['mileage_min']);
				})
				->when($this->filters['notice_types'], function($whenFilter) {
					foreach($this->filters['notice_types'] as $filterNoticeType) {
						$whenFilter->orWhereJsonContains('values_web->notice_type', $filterNoticeType);
					}
				})
				->when($this->filters['price_max'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.price") AS UNSIGNED) <= ?', intval($this->filters['price_max']));
				})
				->when($this->filters['price_min'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.price") AS UNSIGNED) >= ?', intval($this->filters['price_min']));
				})
				->when($this->filters['sectors'], function($whenFilter) {
					foreach($this->filters['sectors'] as $filterSector) {
						$whenFilter->orWhereJsonContains('values_web->sector', $filterSector);
					}
				})
				->when($this->filters['surface_max'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.surface") AS UNSIGNED) <= ?', $this->filters['surface_max']);
				})
				->when($this->filters['surface_min'], function($whenFilter) {
					$whenFilter->whereRaw('CAST(JSON_EXTRACT(`values_web`, "$.surface") AS UNSIGNED) >= ?', $this->filters['surface_min']);
				})
				->when($this->filters['tractor_types'], function($whenFilter) {
					foreach($this->filters['tractor_types'] as $filterTractorType) {
						$whenFilter->orWhereJsonContains('values_web->tractor_type', $filterTractorType);
					}
				})
				->when($this->filters['vehicule_types'], function($whenFilter) {
					foreach($this->filters['vehicule_types'] as $filterVehiculeType) {
						$whenFilter->orWhereJsonContains('values_web->vehicule_type', $filterVehiculeType);
					}
				});
			});
		}

		if($this->thematic->slug == 'transport') {
			$posts = $posts->when($this->filters['availability_max'], function($when) {
				$when->whereHas('availability', function($whereHas) {
					$whereHas->whereBetween('date', '<=', $this->filters['availability_max']);
				});
			})
			->when($this->filters['availability_min'], function($when) {
				$when->whereHas('availability', function($whereHas) {
					$whereHas->where('date', '>=', $this->filters['availability_min']);
				});
			});
		}
		elseif($this->thematic->slug == 'maritime') {
			$posts = $posts->when($this->filters['good_type_id'], function($whenFilter) {
				$whenFilter->whereJsonContains('values_web->goods_type', $this->filters['good_type_id']);
			})
			->when($this->filters['starting_points'], function($whenFilter) {
				foreach($this->filters['starting_points'] as $filterStartingPoint) {
					$whenFilter->orWhereJsonContains('values_web->starting_point', $filterStartingPoint);
				}
			})
			->when($this->filters['destinations'], function($whenFilter) {
				foreach($this->filters['destinations'] as $filterDestination) {
					$whenFilter->orWhereJsonContains('values_web->destinations', $filterDestination);
				}
			});
		}

		$posts = $posts->published()
			->when($this->filters['order_by'], function($when) {
				if($this->filters['order_by'] == 'publication') $when->orderBy('published_at', 'DESC');
				else $when->orderBy('refreshed_at', 'DESC');
			})
			->paginate(30);

		foreach ($posts as $post) {
			views($post)
				->collection('search')
				->record();
		}

		if(session()->has('filters')) session()->forget('filters');
		$this->dispatch('set-post-count', collect($posts)['total']);

		return view('livewire.front.posts.index', [
			'posts' => $posts,
			'collector' => collect($posts),
		]);
	}
}
