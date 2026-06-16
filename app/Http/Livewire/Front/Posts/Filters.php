<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\PostType;

class Filters extends Component
{
	public PostType $postType;

	public $withRedirect = false;
	public $responsive = false;
	public $savedSearch = null;
	public $filters;
	public $cities;
	public $displayPost = 'w-full lg:mx-auto';

	public $autocomplete = false;

	// Lists
	public $postTypesList;

	#[On('location-selected')]
	public function locationSelected($filters)
	{
		$this->filters['country_id'] = $filters['country_id'];
		$this->filters['region_id'] = $filters['region_id'];
		$this->filters['department_id'] = $filters['department_id'];
		$this->filters['city_id'] = $filters['city_id'];
		$this->filters['cities'] = $filters['cities'];
		$this->filters['distance'] = $filters['distance'];

		session()->put('filters', $this->filters);
		// if(!$this->withRedirect) $this->search();
	}

	/*
	#[On('autocompleted')]
	public function Selected($slug)
	{
		if($slug) {
			$breed = Breed::findBySlug($slug);

			if($breed) {
				$this->filters['company_breed'] = $breed->slug;
				session()->put('filters', $this->filters);
				$this->breed = $breed;

				$this->autocomplete = false;

				/*$this->dispatch('breed-selected-in-filters', breed: $this->filters['breed']);

				if(!$this->withRedirect) $this->search();
				else {
					session()->put('filters', $this->filters);
					$this->dispatch('posts-filters', $this->filters);
				}
			}
		}
	}*/

	/*#[On('autocomplete-reset')]
	public function breedEmptied()
	{
		$this->filters['company_breed'] = null;
		session()->put('filters', $this->filters);
		$this->breed = new Breed;

		/*$this->dispatch('breed-selected-in-filters', breed: $this->filters['breed']);

		if(!$this->withRedirect) $this->search();
	}*/

	public function removeLocalisation()
	{
		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = 0;

		$this->dispatch('location-reset');
	}

	public function postTypeSelected()
	{
		if($this->postType->id) {
			/*$this->dispatch('post-type-selected-in-filters', postType: $this->filters['post_type']);

			if(!$this->withRedirect) $this->search();
			else {
				session()->put('filters', $this->filters);
				$this->dispatch('posts-filters', filters: $this->filters);
			}*/
			session()->put('filters', $this->filters);
		}
	}

	public function search()
	{
		if($this->withRedirect) {
			session()->put('filters', $this->filters);

			if($this->filters['post_type']) {
				$postType = PostType::findBySlug($this->filters['post_type'], 'en');

				if($postType) return redirect()->route('post-search.'.$this->species->getTranslation('slug', 'en').'-posts-with-post-type', ['postType' => $postType->getTranslation('slug', 'fr')]);
			}

			return redirect()->route('post-search.'.$this->species->getTranslation('slug', 'en').'-posts');
		}
		else $this->dispatch('posts-filters', $this->filters);
	}

	public function mount()
	{
		$this->filters['post_keyword'] = null;
		$this->filters['post_type'] = null;

		$this->filters['country_id'] = null;
		$this->filters['region_id'] = null;
		$this->filters['department_id'] = null;
		$this->filters['city_id'] = null;
		$this->filters['cities'] = null;
		$this->filters['distance'] = 0;

		$this->postTypesList = PostType::whereNot('slug->en', 'litter-yet-to-come')
			->get();

		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['post_keyword'])) $this->filters['post_keyword'] = $filters['post_keyword'];
			if(!empty($filters['post_type'])) $this->filters['post_type'] = $filters['post_type'];
			if(!empty($filters['country_id'])) $this->filters['country_id'] = $filters['country_id'];
			if(!empty($filters['region_id'])) $this->filters['region_id'] = $filters['region_id'];
			if(!empty($filters['department_id'])) $this->filters['department_id'] = $filters['department_id'];
			if(!empty($filters['city_id'])) $this->filters['city_id'] = $filters['city_id'];
			if(!empty($filters['cities'])) $this->filters['cities'] = $filters['cities'];
			if(!empty($filters['distance'])) $this->filters['distance'] = $filters['distance'];
		}

		if($this->postType->exists) $this->filters['post_type'] = $this->postType->getTranslation('slug', 'en');
	}

	public function render()
	{
		return view('livewire.front.posts.filters');
	}
}
