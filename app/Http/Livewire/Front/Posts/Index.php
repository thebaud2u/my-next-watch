<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use App\Enums\AnimalStates;
use App\Enums\PublicationStates;

use App\Models\{Animal, Breed, City, Litter, Post, PostType, Search, Species};

class Index extends Component
{
	use WithPagination;

	public $filters;
	public Breed $breed;
	public PostType $postType;
	public Species $species;
	public $page;

	#[On('get-posts-filters')]
	public function sendFiltersForSearchSaving(array $filters)
	{
		$filters['species'] = $this->species->getTranslation('slug', 'en');
		$filters['breed'] = $this->filters['breed'];
		$filters['post_type'] = $this->filters['post_type'];
		$filters['country_id'] = $this->filters['country_id'];
		$filters['region_id'] = $this->filters['region_id'];
		$filters['department_id'] = $this->filters['department_id'];
		$filters['city_id'] = $this->filters['city_id'];
		$filters['cities'] = $this->filters['cities'];
		$filters['distance'] = $this->filters['distance'];
		$filters['max_price'] = $this->filters['max_price'];
		$filters['min_price'] = $this->filters['min_price'];
		$filters['pure_breed'] = $this->filters['pure_breed'];

		if($this->postType->getTranslation('slug', 'en') != 'stud') $filters['sex'] = $this->filters['sex'];

		$this->dispatch('send-filters-to-save-search', filters: $filters);
	}

	#[On('posts-filters')]
	public function search(array $filters)
	{
		$this->filters['post_keyword'] = $filters['post_keyword'];
		$this->filters['country_id'] = $filters['country_id'];
		$this->filters['region_id'] = $filters['region_id'];
		$this->filters['department_id'] = $filters['department_id'];
		$this->filters['city_id'] = $filters['city_id'];
		$this->filters['cities'] = $filters['cities'];
		$this->filters['distance'] = $filters['distance'];
		$this->filters['post_type'] = $filters['post_type'];
		$this->filters['breed'] = $filters['breed'];

		$this->page = 1;
	}

	#[On('posts-advanced-filters')]
	public function advancedSearch($filters)
	{
		$this->filters['post_type'] = $filters['post_type'];
		$this->filters['pure_breed'] = $filters['pure_breed'];
		$this->filters['min_price'] = $filters['min_price'];
		$this->filters['max_price'] = $filters['max_price'];
		$this->filters['order_by'] = $filters['order_by'];

		if(!$this->postType) $this->postType = PostType::findBySlug($this->filters['post_type'], 'en');

		if($this->postType) {
			if($this->postType->getTranslation('slug', 'en') != 'stud') $this->filters['sex'] = $filters['sex'];

			if($this->postType->getTranslation('slug', 'en') == 'litter') $this->filters['litter_type'] = $filters['litter_type'];
			elseif($this->postType->getTranslation('slug', 'en') == 'stud') {
				$this->filters['quotation'] = $filters['quotation'];
				$this->filters['protrusion_type'] = $filters['protrusion_type'];
			}
		}

		$this->page = 1;
	}

	public function updatingPage($value)
	{
		$this->page = $value;
	}

	public function getResults()
	{
		$cityIdsInRadius = null;
		if($this->filters['distance'] > 0) {
			$cityId = $this->filters['cities'][0] ?? $this->filters['city_id'] ?? null;

			if($cityId) {
				$city = City::find($cityId);

				if($city) {
					$cityIdsInRadius = City::select('id')
						->whereRaw(
							'ST_Distance_Sphere(point(gps_lng, gps_lat), point(?, ?)) <= ?',
							[$city->gps_lng, $city->gps_lat, $this->filters['distance'] * 1000]
						)->pluck('id')->toArray();
				}
			}
		}

		$addressFilter = function($filter) use($cityIdsInRadius) {
			if(!empty($this->filters['country_id']) && $this->filters['distance'] == 0) $filter->where('country_id', $this->filters['country_id']);
			if(!empty($this->filters['region_id']) && $this->filters['distance'] == 0) $filter->where('region_id', $this->filters['region_id']);
			if(!empty($this->filters['department_id']) && $this->filters['distance'] == 0) $filter->where('department_id', $this->filters['department_id']);
			if(!empty($cityIdsInRadius)) $filter->whereIn('city_id', $cityIdsInRadius);
			elseif(!empty($this->filters['cities']) && $this->filters['distance'] == 0) $filter->whereIn('city_id', $this->filters['cities']);
			elseif(!empty($this->filters['city_id']) && $this->filters['distance'] == 0) $filter->where('city_id', $this->filters['city_id']);
		};

		if(empty($this->filters['post_type']) || ($this->filters['post_type'] == 'litter' && (in_array('litter', $this->filters['litter_type']) || empty($this->filters['litter_type'])))) {
			$animals = Animal::whereHas('company', function($whereHas) {
					$whereHas->whereHas('user');
				})
				->whereHas('species', function($whereHas) {
					$whereHas->where('slug->en', $this->species->getTranslation('slug', 'en'));
				})
				->where(function($where) {
					$where->whereHas('lastLife', function($whereHas) {
						$whereHas->whereIn('state', [AnimalStates::Available, AnimalStates::Reserved]);
					})
					->orDoesntHave('lastLife');
				})
				->when($this->filters['breed'], function($when) {
					$when->whereHas('breed', function($whereHas) {
						$whereHas->where('slug', $this->filters['breed']);
					});
				})
				->when($this->filters['max_price'], function($when) {
					$when->whereRaw('CAST(JSON_UNQUOTE(JSON_EXTRACT(`values`, "$.price")) AS UNSIGNED) <= ?', [$this->filters['max_price']]);
				})
				->when($this->filters['min_price'], function($when) {
					$when->whereRaw('CAST(JSON_UNQUOTE(JSON_EXTRACT(`values`, "$.price")) AS UNSIGNED) >= ?', [$this->filters['min_price']]);
				})
				->when(!is_null($this->filters['pure_breed']), function($when) {
					$when->where('values->pure_breed', $this->filters['pure_breed']);
				})
				->whereHas('litters', function($whereHas) {
					$whereHas->whereHas('post', function($whereHasPosts) {
						$whereHasPosts->whereHas('type', function($whereHasType) {
							$whereHasType->where('slug->en', 'litter');
						})
						->whereHas('lastPublication', function($whereHas) {
							$whereHas->whereIn('state', [
								PublicationStates::Published,
								PublicationStates::PublishedUpdatedWaitingModeration,
								PublicationStates::PublishedUpgradedWaitingModeration
							]);
						});
					});
				})
				->when($this->filters['post_keyword'], function($when) {
					$when->where(function($where) {
						$where->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%')
							->orWhere('slug', 'LIKE', '%'.$this->filters['post_keyword'].'%')
							->orWhere('description', 'LIKE', '%'.$this->filters['post_keyword'].'%')
							->orWhereHas('company', function($whereHasCompany) {
								$whereHasCompany->where(function($whereCompany) {
									$whereCompany->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('slug', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('description', 'LIKE', '%'.$this->filters['post_keyword'].'%');
								})
								->orWhereHas('address', function($whereHasAddress) {
									$whereHasAddress->where('street', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('custom_city', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('custom_province', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('custom_postcode', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhereHas('city', function($whereHasCity) {
											$whereHasCity->where('zip_code', 'LIKE', '%'.$this->filters['post_keyword'].'%')
												->orWhere('name', 'LIKE', '%'.$this->filters['post_keyword'].'%');
										})
										->orWhereHas('country', function($whereHasCountry) {
											$whereHasCountry->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%');
										})
										->orWhereHas('department', function($whereHasDepartment) {
											$whereHasDepartment->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%');
										})
										->orWhereHas('region', function($whereHasRegion) {
											$whereHasRegion->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%');
										});
								});
							});
						});
				})
				->whereHas('company.address', $addressFilter)
				->select('id', 'refreshed_at', 'published_at')
				->get();
		}
		else {
			$animals = Animal::whereRaw('1 = 0')
				->select('id', 'refreshed_at', 'published_at')
				->get();
		}

		$posts = Post::whereHas('user')
			->where(function($where) {
				$where->when($this->filters['post_type'], function($when) {
					if($this->filters['post_type'] === 'litter') {
						$when->where(function($subWhere) {
							$subWhere->whereHas('type', function($whereHas) {
								$whereHas->where('slug->en', 'litter-yet-to-come');
							})
							->orWhere(function($orWhere) {
								$orWhere->whereHas('type', function($whereHas) {
									$whereHas->where('slug->en', 'litter');
								})
								->whereHasMorph('model', [Litter::class], function($whereHasMorph) {
									$whereHasMorph->doesntHave('animals');
								});
							});
						});
					}
					else {
						$when->whereHas('type', function($whereHas) {
							$whereHas->where('slug->en', $this->filters['post_type']);
						});
					}
				}, function($default) {
					$default->where(function($where) {
						$where->whereHas('type', function($whereHas) {
							$whereHas->whereNot('slug->en', 'litter');
						})
						->orWhere(function($orWhere) {
							$orWhere->whereHas('type', function($whereHas) {
								$whereHas->where('slug->en', 'litter');
							})
							->whereHasMorph('model', [Litter::class], function($whereHasMorph) {
								$whereHasMorph->doesntHave('animals');
							});
						});
					});
				});
			})
			->whereHas('lastPublication', function($whereHas) {
				$whereHas->whereIn('state', [
					PublicationStates::Published,
					PublicationStates::PublishedUpdatedWaitingModeration,
					PublicationStates::PublishedUpgradedWaitingModeration
				]);
			})
			->when($this->filters['max_price'], function($when) {
				$when->whereRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(`posts`.`values`, '$.price')) AS UNSIGNED) <= ?", [$this->filters['max_price']]);
			})
			->when($this->filters['min_price'], function($when) {
				$when->whereRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(`posts`.`values`, '$.price')) AS UNSIGNED) >= ?", [$this->filters['min_price']]);
			})
			->whereHasMorph('model', [Animal::class, Litter::class], function($whereHasMorph, $class) use($addressFilter) {
				if($class === Animal::class) {
					$whereHasMorph->whereHas('species', function($whereHas) {
						$whereHas->where('slug->en', $this->species->getTranslation('slug', 'en'));
					})
					->where(function($where) {
						$where->whereHas('lastLife', function($whereHas) {
							$whereHas->whereIn('state', [AnimalStates::Available, AnimalStates::Reserved]);
						})
						->orDoesntHave('lastLife');
					})
					->when($this->filters['breed'], function($when) {
						$when->whereHas('breed', function($whereHas) {
							$whereHas->where('slug', $this->filters['breed']);
						});
					})
					->when($this->filters['max_price'], function($when) {
						$when->whereRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(`posts`.`values`, '$.price')) AS UNSIGNED) <= ?", [$this->filters['max_price']]);
					})
					->when($this->filters['min_price'], function($when) {
						$when->whereRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(`posts`.`values`, '$.price')) AS UNSIGNED) >= ?", [$this->filters['min_price']]);
					})
					->when(!is_null($this->filters['pure_breed']), function($when) {
						$when->where('values->pure_breed', $this->filters['pure_breed']);
					})
					->when($this->filters['sex'], function($when) {
						$when->whereIn('values->sex', $this->filters['sex']);
					})
					->when($this->filters['protrusion_type'], function($when) {
						$types = collect($this->filters['protrusion_type']);

						$when->where(function($where) use($types) {
							$types->each(function($type) use($where) {
								$where->orWhereRaw("JSON_CONTAINS(`values`, '\"$type\"', '$.protrusion_types')");
							});
						});
					})
					->when($this->filters['quotation'], function($when) {
						$when->where('values->quotation', $this->filters['quotation']);
					})
					->whereHas('company.address', $addressFilter);
				}
				elseif($class === Litter::class) {
					$whereHasMorph->when(!is_null($this->filters['pure_breed']), function($when) {
						$when->where(function($where) {
							$where->whereHas('mother', function($whereHas) {
								$whereHas->where('values->pure_breed', $this->filters['pure_breed']);
							})
							->orWhere('values->pure_breed', $this->filters['pure_breed']);
						});
					})
					->whereHas('species', function($whereHas) {
						$whereHas->where('slug->en', $this->species->getTranslation('slug', 'en'));
					})
					->when($this->filters['breed'], function($when) {
						$when->whereHas('breeds', function($whereHas) {
							$whereHas->where('slug', $this->filters['breed']);
						});
					})
					->where(function($where) {
						$where->whereHas('animals', function($whereHasAnimals) {
							$whereHasAnimals->where(function($where) {
								$where->whereHas('lastLife', function($whereHas) {
									$whereHas->whereIn('state', [AnimalStates::Available, AnimalStates::Reserved]);
								})
								->orDoesntHave('lastLife');
							})
							->when($this->filters['max_price'], function($when) {
								$when->whereRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(`posts`.`values`, '$.price')) AS UNSIGNED) <= ?", [$this->filters['max_price']]);
							})
							->when($this->filters['min_price'], function($when) {
								$when->whereRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(`posts`.`values`, '$.price')) AS UNSIGNED) >= ?", [$this->filters['min_price']]);
							})
							->when(!is_null($this->filters['pure_breed']), function($when) {
								$when->where('values->pure_breed', $this->filters['pure_breed']);
							})
							->when($this->filters['sex'], function($when) {
								$when->whereIn('values->sex', $this->filters['sex']);
							});
						})
						->orDoesntHave('animals');
					})
					->whereHas('company.address', $addressFilter);
				}
			})
			->when($this->filters['post_keyword'], function($when) {
				$when->where(function($where) {
					$where->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%')
						->orWhere('slug', 'LIKE', '%'.$this->filters['post_keyword'].'%')
						->orWhere('values->description', 'LIKE', '%'.$this->filters['post_keyword'].'%')
						->orWhereHasMorph('model', [Animal::class, Litter::class], function($orWhereHasMorph, $class) {
							$orWhereHasMorph->where(function($whereClass) use($class) {
								if($class === Litter::class) $whereClass->where('values->description', 'LIKE', '%'.$this->filters['post_keyword'].'%');
								elseif($class === Animal::class) $whereClass->where('description', 'LIKE', '%'.$this->filters['post_keyword'].'%');
							})
							->orWhereHas('company', function($whereHasCompany) {
								$whereHasCompany->where(function($whereCompany) {
									$whereCompany->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('slug', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('description', 'LIKE', '%'.$this->filters['post_keyword'].'%');
								})
								->orWhereHas('address', function($whereHasAddress) {
									$whereHasAddress->where('street', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('custom_city', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('custom_province', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhere('custom_postcode', 'LIKE', '%'.$this->filters['post_keyword'].'%')
										->orWhereHas('city', function($whereHasCity) {
											$whereHasCity->where('zip_code', 'LIKE', '%'.$this->filters['post_keyword'].'%')
												->orWhere('name', 'LIKE', '%'.$this->filters['post_keyword'].'%');
										})
										->orWhereHas('country', function($whereHasCountry) {
											$whereHasCountry->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%');
										})
										->orWhereHas('department', function($whereHasDepartment) {
											$whereHasDepartment->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%');
										})
										->orWhereHas('region', function($whereHasRegion) {
											$whereHasRegion->where('name', 'LIKE', '%'.$this->filters['post_keyword'].'%');
										});
								});
							});
					});
				});
			})
			->select('id', 'refreshed_at', 'published_at')
			->get();

		$merged = $animals->merge($posts);

		$sorted = $merged->sort(function($a, $b) {
			if ($this->filters['order_by'] === 'publication') {
				// Trier par published_at desc, puis id desc
				return $b->published_at <=> $a->published_at ?: $b->id <=> $a->id;
			} else {
				// Trier par refreshed_at desc, puis published_at desc, puis id desc
				return $b->refreshed_at <=> $a->refreshed_at
					?: $b->published_at <=> $a->published_at
					?: $b->id <=> $a->id;
			}
		})->values();

		$pageItems = $sorted->slice(($this->page-1)*30, 30);

		$animals = Animal::whereIn('id', $animals->pluck('id'))->get()->keyBy('id');
		$posts = Post::whereIn('id', $posts->pluck('id'))->get()->keyBy('id');

		// Remplacer les placeholders par les modèles complets
		$items = $pageItems->map(fn($m) => $m instanceof Animal ? $animals[$m->id] : $posts[$m->id]);

		// Paginator final
		$total = $sorted->count();

		$this->dispatch('set-post-count', $total);

		$this->results = new LengthAwarePaginator(
			$items,
			$total,
			30,
			$this->page,
			['path' => url()->current()]
		);
	}

	public function mount()
	{
		// Filters
		$this->filters['post_keyword'] = null;
		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = 0;
		$this->filters['post_type'] = [];
		$this->filters['breed'] = null;

		// Advanced filters
		$this->filters['max_price'] = null;
		$this->filters['min_price'] = null;
		$this->filters['litter_type'] = [];
		$this->filters['pure_breed'] = null;
		$this->filters['quotation'] = null;
		$this->filters['sex'] = [];
		$this->filters['protrusion_type'] = [];

		if($this->postType->exists) $this->filters['post_type'] = $this->postType->getTranslation('slug', 'en');
		if($this->breed->exists) $this->filters['breed'] = $this->breed->slug;

		// Advanced search filters
		$this->filters['order_by'] = 'revelancy';

		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['post_keyword'])) $this->filters['post_keyword'] = $filters['post_keyword'];
			if(!empty($filters['country_id'])) $this->filters['country_id'] = $filters['country_id'];
			if(!empty($filters['region_id'])) $this->filters['region_id'] = $filters['region_id'];
			if(!empty($filters['department_id'])) $this->filters['department_id'] = $filters['department_id'];
			if(!empty($filters['city_id'])) $this->filters['city_id'] = $filters['city_id'];
			if(!empty($filters['cities'])) $this->filters['cities'] = $filters['cities'];
			if(!empty($filters['distance'])) $this->filters['distance'] = $filters['distance'];
			if(!empty($filters['post_type'])) $this->filters['post_type'] = $filters['post_type'];
			if(!empty($filters['breed'])) $this->filters['breed'] = $filters['breed'];

			if(!empty($filters['max_price'])) $this->filters['max_price'] = $filters['max_price'];
			if(!empty($filters['min_price'])) $this->filters['min_price'] = $filters['min_price'];
			if(!empty($filters['litter_type'])) $this->filters['litter_type'] = $filters['litter_type'];
			if(!empty($filters['pure_breed'])) $this->filters['pure_breed'] = $filters['pure_breed'];
			if(!empty($filters['quotation'])) $this->filters['quotation'] = $filters['quotation'];
			if(!empty($filters['sex'])) $this->filters['sex'] = $filters['sex'];
			if(!empty($filters['protrusion_type'])) $this->filters['protrusion_type'] = $filters['protrusion_type'];
		}

		if($this->breed->exists && $this->breed->species->getTranslation('slug', 'en') == $this->species->getTranslation('slug', 'en')) {
			$this->filters['breed'] = $this->breed->slug;
		}
		else {
			$this->filters['breed'] = null;
			$this->breed = new Breed;
		}

		$this->page = request('page', 1);
	}

	public function render()
	{
		$this->getResults();

		foreach($this->results as $result) {
			views($result)
				->collection('search')
				->record();
		}

		if(session()->has('filters')) session()->forget('filters');

		return view('livewire.front.posts.index', [
			'results' => $this->results
		]);
	}
}
