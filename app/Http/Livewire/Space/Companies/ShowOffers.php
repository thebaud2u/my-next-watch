<?php

namespace App\Http\Livewire\Front\Space\Companies;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Enums\PublicationStates;

use App\Models\{Company, Offer, Subscription, User};

class ShowOffers extends Component
{
	// Entities
	public Company $company;
	public Offer $offer;
	public User $user;

	// Properties
	public $currentOffer;
	public $companyState = 'create';
	public $offers;
	public $packOffers;

	public function submitForm($id)
	{
		$offer = Offer::find($id);

		if($offer) {
			if($this->company->id) {
				$this->offer = $this->company->offer();
				$this->user = $this->company->user;

				/*
					If a company exists, we must check it's current offer.
					If it's in draft, the offer is changed and is marked for moderation
				*/
				if($this->offer->id != $id) {
					$lastPublication = $this->company->lastPublication;

					if($lastPublication->isDraft() || $lastPublication->isDraftWaitingModerationForPublication()) {
						$this->company->publications()->create([
							'user_id' => $this->user->id,
							'subscription_id' => $this->user->hasOfferSubscription($offer->slug)->id,
							'state' => $lastPublication->state
						]);
					}
					elseif($lastPublication->isPublished() || $lastPublication->isPublishedUpdatedWaitingModeration()) {
						$this->company->publications()->create([
							'user_id' => $this->user->id,
							'subscription_id' => $this->user->hasOfferSubscription($offer->slug)->id,
							'state' => PublicationStates::PublishedUpgradedWaitingModeration
						]);

						$this->company->markForModeration();
					}
				}

				return redirect()->route('space.companies.update', ['company' => $this->company->slug])->with('success', __('Upgrade complete, you can update your company page'));
			}
			else {
				if($offer->free) {
					if(!$this->user->hasCreditAvailable($offer->slug)) {
						$newSubscription = new Subscription;
						$newSubscription->user_id = $this->user->id;
						$newSubscription->offer_id = $offer->id;
						$newSubscription->quantity = 1;
						$newSubscription->remaining_quantity = 1;
						$newSubscription->end_date = Carbon::now()->addYear();
						$newSubscription->from = 'EOL';
						$newSubscription->synchronized_with_stripe = false;
						$newSubscription->save();
					}
				}

				return redirect()->route('space.companies.create', ['offer' => $offer->slug]);
			}
		}
		else session()->flash('error', __('The given offer doesn\'t exist'));
	}

	public function mount()
	{
		$this->user = Auth::guard('web')->user();

		if($this->company->id) {
			$this->companyState = 'update';
			$this->currentOffer = $this->company->offer();
		}
		else {
			$this->company = new Company;
			$this->companyState = 'create';
			$this->currentOffer = null;
		}

		$offersSlug = Offer::where('type', 'company')
			->orderBy('slug', 'DESC')
			->pluck('slug')
			->toArray();

		$this->offers = Offer::where('type', 'company')
			->orderByRaw("FIELD(slug, '" . implode("','", $offersSlug) . "')")
			->get();

		$this->packOffers = Offer::where('type', 'pack')
			->get();
	}

	public function render()
	{
		return view('livewire.front.space.companies.show-offers');
	}
}
