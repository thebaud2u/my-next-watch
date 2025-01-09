<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Criteria;
use App\Models\PostType;
use App\Models\Thematic;

class Search extends Component
{
	public PostType $postType;
	public Thematic $thematic;

	public $withRedirect = false;
	public $responsive = false;
	public $filters;
	public $cities;
	public $displayPost = 'w-full lg:mx-auto';

	// Lists
	public $fieldPostTypes;
	public $fieldGoodsType;
	public $fieldStartingPoint;
	public $fieldDestinations;
	public $fieldAllPostTypes;

	#[On('location-selected')]
	public function locationSelected($filters)
	{
		$this->filters['country_id'] = $filters['country_id'];
		$this->filters['region_id'] = $filters['region_id'];
		$this->filters['department_id'] = $filters['department_id'];
		$this->filters['city_id'] = $filters['city_id'];
		$this->filters['cities'] = $filters['cities'];
		$this->filters['distance'] = $filters['distance'];

		if(!$this->withRedirect) $this->search();
	}

	public function postTypeSelected()
	{
		// $this->dispatch('post-type-selected-in-search', postType: $this->filters['post_type_id']);

		if(!$this->withRedirect) $this->search();
	}

	public function search()
	{
		if($this->withRedirect) {
			session()->put('filters', $this->filters);

			$postType = PostType::find($this->filters['post_type_id']);

			if($postType) {
				$thematic = $postType->thematic;
				return redirect()->route('posts', ['thematic' => $thematic, 'postType' => $postType]);
			}
			else return redirect()->route('posts');
		}
		else $this->dispatch('posts-search', $this->filters);
	}

	public function mount()
	{
		$this->filters['keyword'] = null;

		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = 0;
		$this->filters['post_type_id'] = null;
		$this->filters['good_type_id'] = null;
		$this->filters['starting_points'] = [];
		$this->filters['destinations'] = [];

		if(empty($this->thematic->id)) {
			$this->fieldAllPostTypes = PostType::orderBy('thematic_id', 'ASC')
				->get();
		}
		else {
			if($this->thematic->slug != 'maritime') $this->fieldPostTypes = $this->thematic->postTypes;
			else {
				$this->fieldGoodsType = Criteria::where('type', '=', 'goods-type')
					->get();
				$this->fieldStartingPoint = Criteria::where('type', '=', 'starting-point')
					->get();
				$this->fieldDestinations = Criteria::where('type', '=', 'destinations')
					->get();
			}

			if($this->postType->id) $this->filters['post_type_id'] = $this->postType->id;
		}

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
		return view('livewire.front.posts.search');
	}
}
