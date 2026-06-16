<?php

namespace App\Http\Livewire\Front\Breeds;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use Illuminate\Database\Eloquent\Collection;

use App\Models\{Breed, Species};

class Index extends Component
{
	use WithPagination;

	public $filters;
	public Species $species;
	
	// Settings
	public $allBreeds = false;
	public $showBreedIndex = false;

	#[On('breeds-filters')]
	public function search(array $filters)
	{
		$this->filters['breed'] = $filters['breed'];
		$this->filters['size'] = $filters['size'];
		$this->filters['hairs'] = $filters['hairs'];
		$this->filters['behavior'] = $filters['behavior'];
	}

	#[On('breeds-advanced-filters')]
	public function advancedSearch($filters)
	{
		$this->filters['grooming_need'] = $filters['grooming_need'];
		$this->filters['attention_need'] = $filters['attention_need'];
		$this->filters['education_need'] = $filters['education_need'];
		$this->filters['activity_need'] = $filters['activity_need'];
		$this->filters['assisting_dog'] = $filters['assisting_dog'];
		$this->filters['breed_rarity'] = $filters['breed_rarity'];
		$this->filters['standard_group'] = $filters['standard_group'];
	}

	#[On('breeds-letters-filter')]
	public function lettersSearch($filters)
	{
		$this->filters['letter'] = $filters['letter'];
	}

	public function mount()
	{
		// Filters
		$this->filters['breed'] = null;
		$this->filters['size'] = null;
		$this->filters['hairs'] = null;
		$this->filters['behavior'] = null;
		$this->filters['search_made'] = false;

		// Advanced filters
		$this->filters['grooming_need'] = null;
		$this->filters['attention_need'] = null;
		$this->filters['education_need'] = null;
		$this->filters['activity_need'] = null;
		$this->filters['assisting_dog'] = null;
		$this->filters['breed_rarity'] = null;
		$this->filters['standard_group'] = null;

		// Letters filter
		$this->filters['letter'] = null;

		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['breed'])) $this->filters['breed'] = $filters['breed'];
			if(!empty($filters['size'])) $this->filters['size'] = $filters['size'];
			if(!empty($filters['hairs'])) $this->filters['hairs'] = $filters['hairs'];
			if(!empty($filters['behavior'])) $this->filters['behavior'] = $filters['behavior'];
			if(!empty($filters['search_made'])) $this->filters['search_made'] = $filters['search_made'];

			if(!empty($filters['letter'])) $this->filters['letter'] = $filters['letter'];

			if(!empty($filters['grooming_need'])) $this->filters['grooming_need'] = $filters['grooming_need'];
			if(!empty($filters['attention_need'])) $this->filters['attention_need'] = $filters['attention_need'];
			if(!empty($filters['education_need'])) $this->filters['education_need'] = $filters['education_need'];
			if(!empty($filters['activity_need'])) $this->filters['activity_need'] = $filters['activity_need'];
			if(!empty($filters['assisting_dog'])) $this->filters['assisting_dog'] = $filters['assisting_dog'];
			if(!empty($filters['breed_rarity'])) $this->filters['breed_rarity'] = $filters['breed_rarity'];
			if(!empty($filters['standard_group'])) $this->filters['standard_group'] = $filters['standard_group'];
		}
	}

	public function render()
	{
		if($this->filters['search_made'] || $this->allBreeds) {
			$breeds = Breed::whereHas('species', function($whereHas) {
					$whereHas->where('slug->en', $this->species->getTranslation('slug', 'en'));
				})
				->when($this->filters['letter'], function($when) {
					$letter = strtoupper($this->filters['letter']);

					$when->where(function($where) use($letter) {
						$where->whereRaw('UPPER(LEFT(name, 1)) = ?', [$letter])
							->orWhereRaw('UPPER(LEFT(slug, 1)) = ?', [$letter]);
					});
				})
				->when($this->filters['breed'], function($when) {
					$when->where('slug', $this->filters['breed']);
				})
				->when($this->filters['size'], function($when) {
					$when->where('values->size', $this->filters['size']);
				})
				->when($this->filters['hairs'], function($when) {
					$when->where('values->hairs', $this->filters['hairs']);
				});

			if($this->filters['search_made']) {
				$breeds = $breeds->when($this->filters['breed_rarity'], function($when) {
						$when->where('values->caracteristics->breed_rarity', true);
					})
					->when($this->filters['standard_group'], function($when) {
						if($this->filters['standard_group'] == 'groupe-11-races-non-reconnues') $when->doesntHave('breedStandard');
						else {
							$when->whereHas('breedStandard', function($whereHasStandard) {
								$whereHasStandard->whereHas('group', function($whereHasStandardGroup) {
									$whereHasStandardGroup->where('slug', $this->filters['standard_group']);
								});
							});
						}
					});

				if($this->species->getTranslation('slug', 'en') == 'dog') {
					$breeds = $breeds->when($this->filters['assisting_dog'], function($when) {
							$when->where('values->caracteristics->assisting_dog', $this->filters['assisting_dog']);
						})
						->when($this->filters['grooming_need'], function($when) {
							$when->where('values->caracteristics->grooming_need', $this->filters['grooming_need']);
						})
						->when($this->filters['attention_need'], function($when) {
							$when->where('values->caracteristics->attention_need', $this->filters['attention_need']);
						})
						->when($this->filters['education_need'], function($when) {
							$when->where('values->caracteristics->education_need', $this->filters['education_need']);
						})
						->when($this->filters['behavior'], function($when) {
							$when->where(function($where) {
								$where->where('values->caracteristics->'.$this->filters['behavior'], '3')
									->orWhere('values->caracteristics->'.$this->filters['behavior'], '4');
							});
						});
				}
				elseif($this->species->getTranslation('slug', 'en') == 'cat') {
					$breeds = $breeds->when($this->filters['activity_need'], function($when) {
						$when->where('values->caracteristics->activity_need', $this->filters['activity_need']);
					});
				}
			}

			$letters = $breeds->orderBy('name', 'ASC')
				->get()
				->pluck('name')
				->map(fn($name) => strtoupper(mb_substr($name, 0, 1)))
				->unique()
				->sort()
				->values();

			$breeds = $breeds->orderBy('name', 'ASC')
				->paginate(30);

			foreach($breeds as $breed) {
				views($breed)
					->collection('search')
					->record();
			}
		}
		else {
			$breeds = new Collection();
			$letters = null;
		}

		//if(session()->has('filters')) session()->forget('filters');

		return view('livewire.front.breeds.index', [
			'breeds' => $breeds,
			'letters' => $letters
		]);
	}
}
