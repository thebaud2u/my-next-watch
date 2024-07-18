<?php

namespace App\Http\Livewire\Front\Space\Favorites;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use Auth;

use App\Models\Post;
use App\Models\User;

class Slot extends Component
{
	use WithPagination;

	// Search filters
	public $keywords;
	public $type = 'all';

	#[On('favorites-search-slot')]
	public function search(array $filters)
	{
		$this->keywords = $filters['keywords'];
		$this->type = $filters['type'];
	}

	public function mount()
	{

	}

	public function render()
	{
		$favorites = collect([]);
		$followed = collect([]);

		if($this->type == 'all' || $this->type == 'favorites') {
			// Favorite posts
			$favorites = Post::whereHas('favoriters', function ($whereHas) {
					$whereHas->where('user_id', Auth::guard('web')->user()->id);
				})
				->when($this->keywords, function ($when) {
					$when->where(function ($where) {
						$where->where('title', 'LIKE', '%'.$this->keywords.'%')
							->orWhere('body', 'LIKE', '%'.$this->keywords.'%');
					});
				})
				->distinct()
				->latest('created_at')
				->paginate(30);
		}

		if($this->type == 'all' || $this->type == 'followed') {
			// Followed users
			$followed = User::whereHas('followers', function ($whereHas) {
					$whereHas->where('user_id', Auth::guard('web')->user()->id);
				})
				->when($this->keywords, function ($when) {
					$when->where(function ($where) {
						$where->where('name', 'LIKE', '%'.$this->keywords.'%');
					});
				})
				->distinct()
				->latest('created_at')
				->paginate(30);
		}

		return view('livewire.front.space.favorites.slot', compact('favorites', 'followed'));
	}
}
