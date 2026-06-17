<?php

namespace App\Http\Livewire\Front\Space\Posts;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Models\{Offer, Post, PostType};

class Filters extends Component
{
	// Search filters
	public $offer = null;
	public $postType = null;
	public $state = null;
	public $filters = [];

	public function search()
	{
		$this->filters = [
			'offer' => $this->offer,
			'postType' => $this->postType,
			'state' => $this->state
		];

		session()->put('filters', $this->filters);

		$this->dispatch('posts-search-slot', [
			'offer' => $this->offer,
			'postType' => $this->postType,
			'state' => $this->state
		]);
	}

	public function resetForm()
	{
		$this->offer = null;
		$this->postType = null;
		$this->state = null;

		$this->search();
	}

	public function mount()
	{
		if(session()->has('filters')) {
			$filters = session()->get('filters');

			if(!empty($filters['offer'])) $this->offer = $filters['offer'];
			if(!empty($filters['postType'])) $this->postType = $filters['postType'];
			if(!empty($filters['state'])) $this->state = $filters['state'];
		}
	}

	public function render()
	{
		$postTypesArray = array();
		$offersArray = array();
		$postsArray = array();

		$posts = Post::whereHas('user', function($whereHas) {
				$whereHas->where('id', Auth::guard('web')->user()->id);
			})
			->get();

		if($posts->isNotEmpty()) {
			foreach($posts as $post) {
				$postsArray[] = $post->id;
				$postTypesArray[] = $post->type->getTranslation('slug', 'en');
				$offersArray[] = $post->offer()->id;
			}
		}

		$filterPostTypes = PostType::whereIn('slug->en', $postTypesArray)
			->distinct()
			->get();

		$filterOffers = Offer::whereIn('id', $offersArray)
			->distinct()
			->orderBy('id', 'ASC')
			->get();

		$filterStates = Post::whereIn('id', $postsArray)
			->whereHas('lastPublication')
			->with('lastPublication')
			->get()
			->pluck('lastPublication.state')
			->unique()
			->values();

		return view('livewire.front.space.posts.filters', [
			'filterOffers' => $filterOffers,
			'filterPostTypes' => $filterPostTypes,
			'filterStates' => $filterStates
		]);
	}
}
