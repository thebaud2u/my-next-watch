<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Enums\PostStatesEnum;

use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\Offer;
use App\Models\Subscription;

class CheckPermissionsCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'check:permissions';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check inactive subscriptions';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$subscriptions = Subscription::where('end_date', '<', Carbon::now()->format('Y-m-d'))
			->whereNull('deleted_at')
			->get();

		$offers = array();
		foreach(Offer::where('is_free', 0)->select('id')->get() as $offer) {
			$offers[] = $offer->id;
		}

		if($subscriptions->isNotEmpty()) {
			foreach($subscriptions as $subscription) {
				if(in_array($subscription->offer->id, $offers)) $subscription->delete();
			}
		}

		return Command::SUCCESS;
	}
}
