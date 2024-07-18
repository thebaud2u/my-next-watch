<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\MailLog;
use App\Models\Company;

class ReminderCompanyMarqueEmployeurExpiresSoonCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'reminder:company-marque-employeur-expires-soon';

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
		$companies = Company::whereHas('subscriptions', function($whereHasSubscriptions) {
				$whereHasSubscriptions->whereHas('offer', function($whereHasOffer) {
						$whereHasOffer->where('slug', '=', 'PGEENTEM');
					})
					->where('end_date', '>', Carbon::now());
			})
			->where('states', '=', 2)
			->get();

		if($companies->isNotEmpty()) {
			foreach($companies as $company) {
				$sendMail = false;
				$subscription = $company->subscriptions()->whereHas('offer', function($whereHas) {
						$whereHas->where('slug', '=', 'PGEENTEM');
					})
					->where('end_date', '>', Carbon::now())
					->first();

				if($subscription && $subscription->subscription) {
					$archivedAt = Carbon::parse($subscription->end_date)->startOfDay();
					$now = Carbon::now()->startOfDay();
					$previousReminder = MailLog::where('user_id', '=', $company->user->id)
						->where('type', '=', 'reminder-company-marque-employeur-expires-soon')
						->latest('created_at')
						->first();

					if($previousReminder) {
						$lastReminderDate = Carbon::parse($previousReminder->created_at)->startOfDay();

						if($previousReminder->reminder_number == 1 && $lastReminderDate->diffInDays($now) == 4) {
							$sendMail = true;
							$reminderNumber = 2;
						}
						else if($previousReminder->reminder_number == 2 && $lastReminderDate->diffInDays($now) == 1) {
							$sendMail = true;
							$reminderNumber = 3;
						}
					}
					else {
						if($now->diffInDays($archivedAt) == 5) {
							$sendMail = true;
							$reminderNumber = 1;
						}
					}
				}

				if($sendMail) {
					$reminder = new MailLog;
					$reminder->user_id = $company->user->id;
					$reminder->type = 'reminder-company-marque-employeur-expires-soon';
					$reminder->reminder_number = $reminderNumber;
					$reminder->save();
				}
			}
		}

		return Command::SUCCESS;
	}
}
