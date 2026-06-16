<?php

namespace App\Http\Livewire\Front\Space\Favorites;

use Livewire\Component;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Enums\AlertTypes;

use App\Models\{Alert, Animal, Breed, BreedClub, Company, User};

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

	public function createAlert()
	{
		$values = new Collection();

		$newAlert = new Alert;
		$newAlert->user_id = Auth::guard('web')->user()->id;
		$newAlert->company_id = $this->target->id;
		$newAlert->type = AlertTypes::Company;
		$newAlert->name = __('Company :company', ['company' =>  $this->target->name]);
		$newAlert->values = $values;
		$newAlert->save();

		$this->dispatch('alert-created');
	}

	public function mount()
	{
		if(Auth::guard('web')->check())	$this->user = Auth::guard('web')->user();
		else $this->user = new User;

		if($this->target instanceof Company) $this->createModal = true;
		
		if($this->target instanceof Animal) {
			$post = $this->target->post ? $this->target->post : $this->target->getPostFromLitter();

			if($post->user && $post->user->id != $this->user->id) $this->createToggle = true;
		}
		elseif($this->target instanceof Breed) $this->createToggle = true;
		elseif($this->target instanceof BreedClub) $this->createToggle = true;
		elseif($this->target->user->id != $this->user->id) $this->createToggle = true;
	}

	public function render()
	{
		return view('livewire.front.space.favorites.toggle-favorite');
	}
}
