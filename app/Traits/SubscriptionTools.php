<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

use App\Models\{Offer, Subscription};

trait SubscriptionTools
{
	// Functions
	// Must always be made on the user entity
	public function hasOfferSubscription($slug): Subscription|null
	{
		return $this->subscriptions()
			->whereHas('offer', function($whereHas) use($slug) {
				$whereHas->where('slug', $slug);
			})
			->where('end_date', '>=', Carbon::now())
			->where('remaining_quantity', '>', 0)
			->first();
	}

	// Must always be made on the user entity
	public function hasCreditAvailable($slug): bool
	{
		return $this->hasOfferSubscription($slug) ? true : false;
	}

	// Must always be made on the user entity
	public function countCreditAvailable($slug): int
	{
		$offer = Offer::findBySlug($slug);
		$count = 0;
		$countReserved = 0;

		$subscriptions = $this->subscriptions()
			->whereHas('offer', function($whereHas) use($slug) {
				$whereHas->where('slug', $slug);
			})
			->where('remaining_quantity', '>', 0)
			->where('end_date', '>=', Carbon::now())
			->get();

		if($subscriptions->isNotEmpty()) {
			foreach($subscriptions as $subscription) {
				$count += $subscription->remaining_quantity;
			}
		}

		if($offer->type == 'post') $countReserved += $this->countPostsWaitingPublicationWithGivenOffer($slug);
		elseif($offer->type == 'pack-activity' || $offer->type == 'pack-secondary-activity') $countReserved += $this->countProfessionnalActivitiessWaitingPublicationWithGivenOffer($slug);

		$count -= $countReserved;

		return $count;
	}

	// Must always be made on the user entity
	public function countCompanyCreditAvailable(): int
	{
		$count = 0;
		$offers = Offer::where('type', 'company')
			->get();

		foreach($offers as $offer) {
			$count += $this->countCreditAvailable($offer->slug);
		}

		return $count;
	}

	// Must always be made on the user entity
	public function getCompanyCreditAvailable(): array
	{
		$creditArray = array();
		$offers = Offer::where('type', 'company')
			->get();

		foreach($offers as $offer) {
			if($this->hasCreditAvailable($offer->slug)) {
				$creditArray[] = [
					'offer' => $offer->name,
					'slug' => $offer->slug,
					'count' => $this->countCreditAvailable($offer->slug),
					'end_date' => $this->hasOfferSubscription($offer->slug)->end_date->format('d/m/Y')
				];
			}
		}

		return $creditArray;
	}

	// Must always be made on the user entity
	public function countPostCreditAvailable(): int
	{
		$count = 0;
		$offers = Offer::where('type', 'post')
			->get();

		foreach($offers as $offer) {
			$count += $this->countCreditAvailable($offer->slug);
		}

		return $count;
	}

	// Must always be made on the user entity
	public function getPostCreditAvailable(): array
	{
		$creditArray = array();
		$offers = Offer::where('type', 'post')
			->get();

		foreach($offers as $offer) {
			if($this->hasCreditAvailable($offer->slug)) {
				$creditArray[] = [
					'offer' => $offer->name,
					'slug' => $offer->slug,
					'count' => $this->countCreditAvailable($offer->slug),
					'end_date' => $this->hasOfferSubscription($offer->slug)->end_date->format('d/m/Y')
				];
			}
		}

		return $creditArray;
	}

	public function countProfessionnalActivityCreditAvailable(): int
	{
		$count = 0;

		if($this->hasRole('professionnal')) $slug = 'annuaire-produits-et-services';
		elseif($this->hasRole('recruiter')) $slug = 'activite-secondaire';

		$offer = Offer::findBySlug($slug);

		$count += $this->countCreditAvailable($offer->slug);

		return $count;
	}

	public function getProfessionnalActivityCreditAvailable(): array
	{
		$creditArray = array();

		if($this->hasRole('professionnal')) $slug = 'annuaire-produits-et-services';
		elseif($this->hasRole('recruiter')) $slug = 'activite-secondaire';

		$offer = Offer::findBySlug($slug);

		if($this->hasCreditAvailable($offer->slug)) {
			$creditArray[] = [
				'offer' => $offer->name,
				'slug' => $offer->slug,
				'count' => $this->countCreditAvailable($offer->slug),
				'end_date' => $this->hasOfferSubscription($offer->slug)->end_date->format('d/m/Y')
			];
		}

		return $creditArray;
	}

	public function consumeCredit(): Subscription|bool
	{
		$countReserved = 0;
		$lastPublication = $this->lastPublication;
		$subscription = $lastPublication->subscription;

		if($subscription->offer->type == 'post') $countReserved += $this->user->countPostsWaitingPublicationWithGivenOffer($subscription->offer->slug);
		elseif($subscription->offer->type == 'pack-activity' || $subscription->offer->type == 'pack-secondary-activity') $countReserved += $this->user->countProfessionnalActivitiessWaitingPublicationWithGivenOffer($subscription->offer->slug);

		if($subscription->remaining_quantity > 0 && $subscription->remaining_quantity - $countReserved >= 0 && $subscription->end_date >= Carbon::now()) {
			$subscription->remaining_quantity--;
			$subscription->save();

			return $subscription;
		}
		else {
			$hasSubscription = $this->user->hasOfferSubscription($subscription->offer->slug);

			if(!$hasSubscription && $subscription->offer->type == 'company' && $subscription->offer->free) {
				$offer = Offer::findBySlug('page-elevage-standard');

				$newSubscription = new Subscription;
				$newSubscription->user_id = $this->user->id;
				$newSubscription->offer_id = $offer->id;
				$newSubscription->quantity = 1;
				$newSubscription->remaining_quantity = 1;
				$newSubscription->end_date = Carbon::now()->addYear();
				$newSubscription->from = 'EOL';
				$newSubscription->synchronized_with_stripe = false;
				$newSubscription->save();

				$hasSubscription = $newSubscription;
			}

			if($hasSubscription && ($subscription->offer->type == 'company' || ($subscription->offer->type != 'company' && $hasSubscription->remaining_quantity - $countReserved > 0))) {
				$hasSubscription->remaining_quantity--;
				$hasSubscription->save();

				return $hasSubscription;
			}
			else return false;
		}
	}

	public function getLastSubscriptionForOffer($slug)
	{
		return $this->subscriptions()->whereHas('offer', function($whereHas) use($slug) {
				$whereHas->where('slug', $slug);
			})
			->latest()
			->first();
	}
}
