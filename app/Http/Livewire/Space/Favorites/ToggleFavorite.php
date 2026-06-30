<?php

namespace App\Http\Livewire\Space\Favorites;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Models\{Brand, Collection, User, Watch};

class ToggleFavorite extends Component
{
	public User $user;
	public $createToggle = false;
	public $createModal = false;
	public $target;

	public function toggleFavorite()
	{
		$this->user->toggleFavorite($this->target);

		if($this->target instanceof Company) {
			if($this->user->hasFavorited($this->target)) $this->dispatch('open-modal', 'follow-company-modal');
			else {
				$companyAlert = $this->user->alerts()->where('type', AlertTypes::Company)
					->whereHas('company', function($whereHas) {
						$whereHas->where('slug', $this->target->slug);
					})
					->first();

				if($companyAlert) $companyAlert->delete();
			}
		}
	}

	public function mount()
	{
		if(Auth::guard('web')->check())	$this->user = Auth::guard('web')->user();
		else $this->user = new User;
	}

	public function render()
	{
		return view('livewire.space.favorites.toggle-favorite');
	}
}
