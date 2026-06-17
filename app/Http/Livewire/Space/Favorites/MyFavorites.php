<?php

namespace App\Http\Livewire\Front\Space\Favorites;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Models\{Animal, Breed, BreedClub, Company, Post, ProfessionnalActivity};

class MyFavorites extends Component
{
	public $class;
	public $type;
	public $page;

	// Search filters
	public $keywords;

	#[On('favorites-search-slot')]
	public function search(array $filters)
	{
		$this->keywords = $filters['keywords'];
	}

	public function updatingPage($value)
	{
		$this->page = $value;
	}

	public function mount()
	{
		if($this->type == 'breeds') $this->class = Breed::class;
		elseif($this->type == 'breed-clubs') $this->class = BreedClub::class;
		elseif($this->type == 'companies') $this->class = Company::class;
		elseif($this->type == 'posts') $this->class = Post::class;
		elseif($this->type == 'professionnal-activities') $this->class = ProfessionnalActivity::class;
	}

	public function render()
	{
		if($this->type == 'posts') {
			$animals = Animal::whereHas('favoriters', function ($whereHas) {
					$whereHas->where('user_id', Auth::guard('web')->user()->id);
				})
				->whereHas('company', function($whereHas) {
					$whereHas->whereHas('user');
				})
				->when($this->keywords, function ($when) {
					$when->where(function ($where) {
						$where->where('name', 'LIKE', '%'.$this->keywords.'%')
							->orWhere('description', 'LIKE', '%'.$this->keywords.'%');
					});
				})
				->select('id', 'created_at')
				->get();

			$posts = Post::whereHas('favoriters', function ($whereHas) {
					$whereHas->where('user_id', Auth::guard('web')->user()->id);
				})
				->whereHas('user')
				->when($this->keywords, function ($when) {
					$when->where(function ($where) {
						$where->where('name', 'LIKE', '%'.$this->keywords.'%')
							->orWhere('description', 'LIKE', '%'.$this->keywords.'%');
					});
				})
				->select('id', 'created_at')
				->get();

			$merged = $animals->merge($posts);

			$sorted = $merged->sort(function($a, $b) {
				return $b->created_at <=> $a->created_at ?: $b->id <=> $a->id;
			})->values();

			$pageItems = $sorted->slice(($this->page-1)*30, 30);

			$animals = Animal::whereIn('id', $animals->pluck('id'))->get()->keyBy('id');
			$posts = Post::whereIn('id', $posts->pluck('id'))->get()->keyBy('id');

			// Remplacer les placeholders par les modèles complets
			$items = $pageItems->map(fn($m) => $m instanceof Animal ? $animals[$m->id] : $posts[$m->id]);

			// Paginator final
			$total = $sorted->count();

			$favorites = new LengthAwarePaginator(
				$items,
				$total,
				30,
				$this->page,
				['path' => url()->current()]
			);
		}
		else {
			$favorites = $this->class::whereHas('favoriters', function ($whereHas) {
				$whereHas->where('user_id', Auth::guard('web')->user()->id);
			})
			->when($this->keywords, function ($when) {
				$when->where(function ($where) {
					$where->where('name', 'LIKE', '%'.$this->keywords.'%')
						->orWhere('description', 'LIKE', '%'.$this->keywords.'%');
				});
			})
			->paginate(30);
		}

		return view('livewire.front.space.favorites.my-favorites', compact('favorites'));
	}
}
