<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\{ Category, PostType, Search, Thematic };

class AdvancedSearch extends Component
{
	public Category $category;
	public PostType $postType;
	public Search $savedSearch;
	public Thematic $thematic;

	public $filters;
	public $criterias;
	public $responsive = false;

	#[On('post-type-selected-in-search')]
	public function setPostType($postType)
	{
		$this->postType = PostType::find($postType);
		$this->thematic = Thematic::find($this->postType->thematic->id);
		$this->loadCriterias();
	}

	public function loadCriterias()
	{
		if(!$this->postType->id) $this->postType = $this->thematic->postTypes->first();

		$criterias = $this->postType->criterias->groupBy('type');

		foreach($criterias as $criteria => $criteriaValues) {
			$this->criterias[$criteria] = $criteriaValues;
		}
	}

	public function search()
	{
		$this->dispatch('posts-advanced-search', filters: $this->filters);
	}

	public function resetForm()
	{
		$this->filters['order_by'] = 'publication';

		if($this->thematic->slug == 'transport') {
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
		}
		elseif($this->thematic->slug == 'social') {
			$this->filters['notice_types'] = [];
			$this->filters['closing_date_max'] = null;
			$this->filters['closing_date_min'] = null;
		}

		$this->dispatch('form-reset');
		$this->search();
	}

	public function mount(?Search $savedSearch = null)
	{
		if (empty($savedSearch?->id)) {
			$this->filters['order_by'] = 'publication';

			if($this->thematic->slug == 'transport') {
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
			}
			elseif($this->thematic->slug == 'social') {
				$this->filters['notice_types'] = [];
				$this->filters['closing_date_max'] = null;
				$this->filters['closing_date_min'] = null;
			}
		} else {
			$this->filters = $savedSearch->filters->all();
		}

		$this->loadCriterias();
	}

	public function render()
	{
		return view('livewire.front.posts.advanced-search');
	}
}
