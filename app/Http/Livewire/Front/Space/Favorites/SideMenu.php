<?php

namespace App\Http\Livewire\Front\Space\Favorites;

use Livewire\Component;

use Auth;

class SideMenu extends Component
{
	// Search filters
	public $keywords;
	public $type = 'all';

	public function search()
	{
		$this->dispatch('favorites-search-slot', [
			'keywords' => $this->keywords,
			'type' => $this->type
		]);
	}

	public function resetForm()
	{
		$this->keywords = '';
		$this->type = 'all';

		$this->search();
	}

	public function render()
	{
		return view('livewire.front.space.favorites.side-menu');
	}
}
