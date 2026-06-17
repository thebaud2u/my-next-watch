<?php

namespace App\Http\Livewire\Front\Space\Profile;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class Stats extends Component
{
	public User $user;
	public $where = 'all';
	public $isHome = false;

	public function mount()
	{
		$this->user = Auth::guard('web')->user();
	}

	public function render()
	{
		return view('livewire.front.space.profile.stats');
	}
}
