<?php

namespace App\Http\Livewire\Admin\Subscriptions;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\{Offer, Subscription, User};

class Subscriptions extends Component
{
	use WithPagination;

	// Filters
	public $keyword;
	public $offer;
	public $offersList;

	// Properties
	public Subscription $subscription;
	public User $user;
	public $userEmail;
	public $foundUsers;
	public $offerSelected;
	public $creditRemaining;
	public $expirationDate;
	public $comment;

	protected function rules()
	{
		return [
			'userEmail' => [''],
			'newSubscription.user_id' => [''],
			'newSubscription.offer_id' => [''],
			'newSubscription.remaining_quantity' => [''],
			'newSubscription.end_date' => [''],
			'newSubscription.reference' => [''],
			'userSubscription.remaining_quantity' => [''],
			'userSubscription.end_date' => [''],
			'userSubscription.reference' => ['']
		];
	}

	public function searchRegistered()
	{
		if($this->userEmail) {
			$this->foundUsers = User::where('email', 'LIKE', '%'.$this->userEmail.'%')
				->get();
		}
	}

	public function selectUser($id)
	{
		$this->user = User::find($id);
		$this->userEmail = $this->user->email;
		$this->foundUsers = null;
	}

	public function fresh()
	{
		$this->subscription = new Subscription;
		$this->user = new User;
		$this->userEmail = null;
		$this->foundUsers = null;
		$this->offerSelected = null;
		$this->creditRemaining = null;
		$this->expirationDate = null;
		$this->comment = null;

		$this->dispatch('subscription-reset');
	}

	public function getSubscription($id)
	{
		$this->fresh();

		$this->subscription = Subscription::withTrashed()->find($id);
		$this->creditRemaining = $this->subscription->remaining_quantity;
		$this->expirationDate = $this->subscription->end_date?->format('Y-m-d');
		$this->comment = $this->subscription->comment;

		$this->dispatch('subscription-loaded');
	}

	public function setSubscription()
	{
		$rules = [
			'userEmail' => ['required', 'email'],
			'offerSelected' => ['required'],
			'creditRemaining' => ['required', 'numeric', 'min:1'],
			'expirationDate' => ['required', 'date']
		];

		$messages = [
			'userEmail.required' => __(':element is mandatory', ['element' => __('The user')]),
			'userEmail.email' => __(':element is expected', ['element' => __('An email address')]),
			'offerSelected.required' => __(':element is mandatory', ['element' => __('The offer')]),
			'creditRemaining.required' => __(':element is mandatory', ['element' => __('The remaining quantity')]),
			'creditRemaining.min' => __('Minimum 1 credit'),
			'expirationDate.required' => __(':element is mandatory', ['element' => __('The expiration date')]),
			'expirationDate.date' => __(':element is expected', ['element' => __('A date dd/mm/yyyy')])
		];

		$this->validate($rules, $messages);

		$newSubscription = new Subscription;
		$newSubscription->user_id = $this->user->id;
		$newSubscription->offer_id = $this->offerSelected;
		$newSubscription->quantity = $this->creditRemaining;
		$newSubscription->remaining_quantity = $this->creditRemaining;
		$newSubscription->end_date = $this->expirationDate;
		$newSubscription->from = 'EOL';
		$newSubscription->synchronized_with_stripe = 0;
		$newSubscription->comment = $this->comment;
		$newSubscription->save();

		$this->dispatch('subscription-validated');

		$this->fresh();
	}

	public function updateSubscription()
	{
		$rules = [
			'creditRemaining' => ['required', 'numeric', 'min:0'],
			'expirationDate' => ['required', 'date']
		];

		$messages = [
			'creditRemaining.required' => 'Le nombre de crédit restant est obligatoire',
			'creditRemaining.numeric' => 'Une valeur numérique est attendue',
			'creditRemaining.min' => '0 crédit restant minimum',
			'expirationDate.required' => 'La date d\'expiration est obligatoire',
			'expirationDate.date' => 'Une date est attendue (jj/mm/aaaa)'
		];

		$this->validate($rules, $messages);

		$change = false;
		if(
			$this->subscription->remaining_quantity != $this->creditRemaining ||
			$this->subscription->end_date != $this->expirationDate
		) $this->subscription->synchronized_with_stripe = false;

		$this->subscription->remaining_quantity = $this->creditRemaining;
		$this->subscription->end_date = $this->expirationDate;
		$this->subscription->comment = $this->comment;

		if($this->subscription->trashed() && $this->subscription->end_date > $this->subscription->deleted_at) $this->subscription->deleted_at = null;

		$this->subscription->save();

		$this->dispatch('subscription-validated');

		$this->fresh();
	}

	public function mount()
	{
		$this->fresh();

		$this->offersList = Offer::orderBy('type', 'ASC')
			->orderBy('name', 'ASC')
			->get();
	}

	public function render()
	{
		$subscriptions = Subscription::when($this->offer, function($when) {
				$when->whereHas('offer', function($whereHas) {
					$whereHas->where('slug', $this->offer);
				});
			})
			->when($this->keyword, function ($when) {
				$when->whereHas('user', function($whereHas) {
					$whereHas->where('lastname', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('firstname', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('email', 'LIKE', '%'.$this->keyword.'%');
					})
					->orWhere('created_at', 'LIKE', '%'.$this->keyword.'%')
					->orWhere('end_date', 'LIKE', '%'.$this->keyword.'%')
					->orWhere('comment', 'LIKE', '%'.$this->keyword.'%');
			})
			->withTrashed()
			->paginate(10);

		return view('livewire.admin.subscriptions.subscriptions', [
			'subscriptions' => $subscriptions
		]);
	}
}
