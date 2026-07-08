<?php

namespace App\Http\Livewire\Widgets;

use Livewire\Component;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RecentlyViewed extends Component
{
	public $type = 'watches';
	public $results;

	public function mount()
	{
		if(Auth::guard('web')->check()) {
			if($this->type == 'watches') $results = Auth::guard('web')->user()->recentlyViewedWatches();
		}
		else $results = new Collection();
	}

	public function render()
	{
		return view('livewire.widgets.recently-viewed', compact('results'));
	}
}
