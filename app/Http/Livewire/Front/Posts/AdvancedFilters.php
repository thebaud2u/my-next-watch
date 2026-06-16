<?php

namespace App\Http\Livewire\Front\Posts;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\PostType;

class AdvancedFilters extends Component
{
	public PostType $postType;
	public Species $species;

	public $filters;
	public $responsive = false;

	// Filters fields
	public $animalSexes;
	public $litterTypes;
	public $protrusionTypes;

	#[On('post-type-selected-in-filters')]
	public function setPostType($postType)
	{
		if($postType) {
			$this->postType = PostType::findBySlug($postType, 'en');

			if($this->postType) $this->filters['post_type'] = $postType;
		}

		$this->search();
	}

	public function search()
	{
		$this->dispatch('posts-advanced-filters', filters: $this->filters);
	}

	public function resetForm()
	{
		$this->filters['max_price'] = null;
		$this->filters['min_price'] = null;
		$this->filters['order_by'] = 'revelancy';

		$this->dispatch('form-reset');
		$this->search();
	}

	public function mount()
	{
		$this->filters['max_price'] = null;
		$this->filters['min_price'] = null;
		$this->filters['post_type'] = $this->postType->getTranslation('slug', 'en');
		$this->filters['order_by'] = 'revelancy';

		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['max_price'])) $this->filters['max_price'] = $filters['max_price'];
			if(!empty($filters['min_price'])) $this->filters['min_price'] = $filters['min_price'];
		}
	}

	public function render()
	{
		return view('livewire.front.posts.advanced-filters');
	}
}
