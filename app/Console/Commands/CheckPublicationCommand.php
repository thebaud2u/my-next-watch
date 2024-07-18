<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Enums\PostStatesEnum;

use App\Models\Company;
use App\Models\Post;

class CheckPublicationCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'check:publication';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check post publication date validity';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$posts = Post::query()
			->where('archived_at', '<', Carbon::today())
			->where('state', PostStatesEnum::Published)
			->get();


		if($posts->isNotEmpty()) {
			foreach ($posts as $post) {
				$post->state = PostStatesEnum::Archived;
				$post->save();
			}
		}

		$companies = Company::with([
				'offer',
				'subscriptions'
			])
			->whereHas('offer', function($whereHas) {
				$whereHas->whereIn('slug', ['PGEENTEM', 'PGEENTEM+']);
			})
			->whereHas('subscriptions', function($whereHas) {
				$whereHas->where('end_date', '<', Carbon::now());
			})
			->get();

		if($companies->isNotEmpty()) {
			foreach($companies as $company) {
				$company->options()->detach();
				$company->offer_id = 9;
				$company->save();

				foreach ($company->offer->options as $option) {
					$company->options()->attach($option->id);
				}

				$newCompanySubscription = new CompanySubscription;
				$newCompanySubscription->company_id = $company->id;
				$newCompanySubscription->offer_id = 9;
				$newCompanySubscription->user_id = $company->user->id;
				$newCompanySubscription->save();
			}
		}

		return Command::SUCCESS;
	}
}
