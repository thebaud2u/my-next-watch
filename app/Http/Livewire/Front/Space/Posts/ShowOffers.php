<?php

namespace App\Http\Livewire\Front\Space\Posts;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\{Offer, Post, User};

class ShowOffers extends Component
{
	// Entities
	public Offer $offer;
	public Post $post;
	public User $user;

	// Properties
	public $offers;
	public $postState = 'create';

	public function submitForm($id)
	{
		$offer = Offer::find($id);

		if($offer) return redirect()->route('space.posts.create', ['offer' => $offer->slug]);
		else session()->flash('error', __('The given offer doesn\'t exist'));
	}

	public function mount()
	{
		if($this->post->exists) {
			$this->currentOffer = $this->post->offer();

			$this->offers = Offer::where('type', 'post')
				->where('slug', $this->currentOffer->slug)
				->get();
		}
		else {
			$this->post = new Post;
			$this->postState = 'create';
			$this->currentOffer = null;

			$offersSlug = Offer::where('type', 'post')
				->orderBy('slug', 'DESC')
				->pluck('slug')
				->toArray();

			$this->offers = Offer::where('type', 'post')
				->orderByRaw("FIELD(slug, '" . implode("','", $offersSlug) . "')")
				->get();
		}
	}

	public function render()
	{
		return view('livewire.front.space.posts.show-offers');
	}
}
