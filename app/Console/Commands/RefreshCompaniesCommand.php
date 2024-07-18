<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Enums\CompanyStatesEnum;

use App\Models\Company;

class RefreshCompaniesCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'refresh:companies';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh companies';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$companiesDailyRefresh = Company::whereHas('options', function($whereHas) {
				$whereHas->where('code', '=', 'daily_refresh');
			})
			->where('state', '!=', CompanyStatesEnum::Draft)
			->get();

		if($companiesDailyRefresh->isNotEmpty()) {
			foreach($companiesDailyRefresh as $companyDailyRefresh) {
				$company = Company::find($companyDailyRefresh->id);
				$company->refreshed_at = Carbon::now();
				$company->save();
			}
		}

		return Command::SUCCESS;
	}
}
