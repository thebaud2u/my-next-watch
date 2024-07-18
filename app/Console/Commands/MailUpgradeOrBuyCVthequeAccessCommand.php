<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\MailLog;
use App\Models\Post;

class MailUpgradeOrBuyCVthequeAccessCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'mail:upgrade-or-buy-cvtheque-access';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$registeredsWithStandardOrPremiumPosts = Post::where(function($where) {
				$where->whereYear('published_at', '=', Carbon::now()->subMonth()->format('Y'))
					->whereMonth('published_at', '=', Carbon::now()->subMonth()->format('m'))
					->whereDay('published_at', '=', Carbon::now()->subMonth()->format('d'));
			})
			->where('state', '=', 4)
			->whereHas('offer', function($whereHas) {
				$whereHas->whereIn('slug', ['F1ASHSTAN', 'F2ASHPREM', 'F1ASH1/4C', 'F1ASH1/2C', 'F1ASH1C', 'F2ASH1/4C', 'F2ASH1/2C', 'F2ASH1C']);
			})
			->whereHas('user', function($whereHas) {
				$whereHas->groupBy('id');
			})
			->get();

		if($registeredsWithStandardOrPremiumPosts->isNotEmpty()) {
			foreach($registeredsWithStandardOrPremiumPosts as $registeredWithStandardOrPremiumPosts) {
				$sendMail = false;

				if($sendMail) {
					$reminder = new MailLog;
					$reminder->user_id = $registeredWithStandardOrPremiumPosts->user->id;
					$reminder->post_id = $registeredWithStandardOrPremiumPosts->id;
					$reminder->type = 'mail-upgrade-or-buy-cvtheque-access';
					$reminder->save();
				}
			}
		}

		return Command::SUCCESS;
	}
}
