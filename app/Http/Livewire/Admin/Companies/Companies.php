<?php

namespace App\Http\Livewire\Admin\Companies;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Enums\{PublicationStates};

use App\Models\{Admin, Company, Offer, User};

class Companies extends Component
{
	use WithFileUploads, WithPagination;

	// Filters
	public $keyword;
	public $offer;
	public $offersList;
	public $state;
	public $statesList;
	public $user;
	public $usersList;

	// Properties
	public Company $company;

	public $currentExpirationDate;
	public $newExpirationDate;

	protected function rules() {
		return [
			'newExpirationDate' => [],
		];
	}

	public function fresh()
	{
		$this->company = new Company;

		$this->dispatch('company-reset');
	}

	public function getCompany($id)
	{
		$this->fresh();

		$this->company = Company::find($id);

		$lastPublication = $this->company->lastPublication;

		if(!$lastPublication->subscription->offer->free) {
			$this->currentExpirationDate = $lastPublication->subscription->end_date->format('d/m/Y');
		}

		$this->dispatch('company-loaded');
	}

	public function setCompany()
	{
		/*$rules = [

		];

		$messages = [

		];

		$this->validate($rules, $messages);*/



		$this->dispatch('company-validated');

		$this->fresh();
	}

	public function setExpirationDate()
	{
		$rules = [
			'newExpirationDate' => ['required'],
		];

		$messages = [
			'newExpirationDate.required' => __(':element is mandatory', ['element' => __('The new date of expiration')])
		];

		$this->validate($rules, $messages);

		$lastPublication = $this->company->lastPublication;

		$lastPublication->end_date = $this->newExpirationDate;
		$lastPublication->save();

		$this->dispatch('company-validated');

		$this->fresh();
	}

	public function deleteCompany()
	{
		if($this->company->exists) {
			$this->company->delete();

			session()->flash('success', __(':element deleted', ['element' => __('Company')]));

			$this->dispatch('company-deleted');
		}
	}

	public function toggleSNPCC($id)
	{
		$company = Company::find($id);

		if($company) {
			if(!$company->values->has('snpcc')) {
				$values = $company->values;
				$values->put('snpcc', true);
				$company->values = $values;
			}
			else {
				$snpcc = $company->values->get('snpcc');
				$company->updateValue('snpcc', !$snpcc);
			}

			$company->save();
		}
	}

	public function mount()
	{
		$this->fresh();

		$this->offersList = Offer::where('type', 'company')
			->get();
		$this->statesList = PublicationStates::asHumanArray();

		$this->usersList = User::whereHas('roles', function($whereHas) {
				$whereHas->whereIn('name', ['breeder', 'individual_breeder', 'professionnal_breeder']);
			})
			->orderBy('lastname', 'ASC')
			->orderBy('firstname', 'ASC')
			->get();
	}

	public function render()
	{
		$companies = Company::when($this->user, function($when) {
				$when->where('slug', $this->user);
			})
			->when($this->keyword, function($when) {
				$when->where(function($where) {
					$where->where('name', 'LIKE', '%'.$this->keyword.'%')
						->orWhere('slug', 'LIKE', '%'.$this->keyword.'%')
						->orWhereHas('user', function($whereHas) {
							$whereHas->where('lastname', 'LIKE', '%'.$this->keyword.'%')
								->orWhere('firstname', 'LIKE', '%'.$this->keyword.'%')
								->orWhere('email', 'LIKE', '%'.$this->keyword.'%')
								->orWhere('slug', 'LIKE', '%'.$this->keyword.'%');
						});
				});
			})
			->when($this->state, function($when) {
				$when->whereHas('lastPublication', function($whereHas) {
					$whereHas->where('state', $this->state);
				});
			})
			->when($this->offer, function($when) {
				$when->whereHas('lastPublication', function($whereHas) {
					$whereHas->whereHas('subscription', function($whereHasSubscription) {
						$whereHasSubscription->whereHas('offer', function($whereHasOffer) {
							$whereHasOffer->where('slug', $this->offer);
						});
					});
				});
			})
			->whereHas('user')
			->paginate(10);

		return view('livewire.admin.companies.companies', [
			'companies' => $companies,
		]);
	}
}
