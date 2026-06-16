<?php

namespace App\Http\Livewire\Front\Space;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class Stats extends Component
{
	public $element;
	public $favorites = 0;
	public $views = 0;
	public $responses = 0;
	public $loaded = false;

	public function loadStats()
	{
		$this->favorites = $this->element->favoriters()->count();
		$this->views = views($this->element)->unique()->count();
		$this->responses = $this->element->responses()->count();
		$this->loaded = true;
	}

	public function mount()
	{

	}

	public function render()
	{
		return view('livewire.front.space.stats');
	}
}
