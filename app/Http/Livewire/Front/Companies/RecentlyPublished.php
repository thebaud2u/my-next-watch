<?php

namespace App\Http\Livewire\Front\Companies;

use Livewire\Component;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

use App\Enums\PublicationStates;

use App\Models\Company;

class RecentlyPublished extends Component
{
	public $mode = 5;
	public $doubleColumnDisplay = false;

	protected function baseCompanyQuery(): Builder
	{
		return Company::whereHas('user')
			->whereHas('lastPublication', function($whereHas) {
				$whereHas->whereIn('state', [
					PublicationStates::Published,
					PublicationStates::PublishedUpdatedWaitingModeration,
					PublicationStates::PublishedUpgradedWaitingModeration
				])
				->whereHas('subscription', function($whereHasSubscription) {
					$whereHasSubscription->whereHas('offer', function($whereHasOffer) {
						$whereHasOffer->where('slug', 'page-elevage-master');
					});
				});
			});
	}

	protected function baseCountAllCompanyQuery(): Builder
	{
		return Company::whereHas('user')
			->whereHas('lastPublication', function($whereHas) {
				$whereHas->whereIn('state', [
					PublicationStates::Published,
					PublicationStates::PublishedUpdatedWaitingModeration,
					PublicationStates::PublishedUpgradedWaitingModeration
				]);
			});
	}

	public function mount()
	{

	}

	public function render()
	{
		$key = 'recently_published_company_' . md5(json_encode([
			'mode' => $this->mode
		]));

		$companies = Cache::remember($key, now()->addDay(), function () {
			return $this->baseCompanyQuery()
				->latest()
				->take($this->mode)
				->get();
		});

		$key = 'count_all_companies_' . md5(json_encode([]));

		$countCompanies = Cache::remember($key, now()->addDay(), function () {
			return $this->baseCountAllCompanyQuery()
				->count();
		});

		return view('livewire.front.companies.recently-published', [
			'companies' => $companies,
			'countCompanies' => $countCompanies
		]);
	}
}
