<?php

namespace App\Http\Livewire\Front\Space\Posts;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Enums\PublicationStates;

use App\Models\{Offer, Post};

class MyPosts extends Component
{
	use WithPagination;

	// Search filters
	public $offer = null;
	public $postType = null;
	public $state = null;

	#[On('posts-search-slot')]
	public function search(array $filters)
	{
		$this->offer = $filters['offer'];
		$this->postType = $filters['postType'];
		$this->state = $filters['state'];
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
		$posts = Post::when($this->offer, function($when) {
				$when->whereHas('lastPublication', function($whereHasPublication) {
					$whereHasPublication->whereHas('subscription', function($whereHasSubscription) {
						$whereHasSubscription->whereHas('offer', function($whereHasOffer) {
							$whereHasOffer->where('slug', $this->offer);
						});
					});
				});
			})
			->when($this->postType, function($when) {
				$when->whereHas('type', function($whereHas) {
					$whereHas->where('slug->en', $this->postType);
				});
			})
			->when($this->state, function($when) {
				$when->whereHas('lastPublication', function($whereHas) {
					$whereHas->where('state', $this->state);
				});
			})
			->whereHas('user', function($whereHas) {
				$whereHas->where('id', '=', Auth::guard('web')->user()->id);
			})
			->distinct()
			->latest('created_at')
			->paginate(30);

		return view('livewire.front.space.posts.my-posts', compact('posts'));
	}
}
