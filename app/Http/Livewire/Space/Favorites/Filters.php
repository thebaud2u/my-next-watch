<?php

namespace App\Http\Livewire\Front\Space\Favorites;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class Filters extends Component
{
	// Search filters
	public $keywords;

	public function search()
	{
		$this->dispatch('favorites-search-slot', [
			'keywords' => $this->keywords
		]);
	}

	public function resetForm()
	{
		$this->keywords = '';

		$this->search();
	}

	public function render()
	{
		return view('livewire.front.space.favorites.filters');
	}
}
