<?php

namespace App\Http\Livewire\Front\Space\Account;

use Livewire\Component;
use Livewire\Attributes\On;

class SideMenu extends Component
{
	public $active = 'account';

	public function sideMenuChange($active)
	{
		$this->active = $active;
		$this->dispatch('side-menu-change', active: $this->active);
	}

	#[On('slot-change')]
	public function slotChange($active)
	{
		$this->active = $active;
	}

	public function mount($active)
	{
		$this->active = $active;
	}

	public function render()
	{
		return view('livewire.front.space.account.side-menu');
	}
}
