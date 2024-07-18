<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\MailLog;
use App\Models\Subscription;

class ReminderCVthequeSubscriptionExpiresSoonCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'reminder:CVtheque-subscription-expires-soon';

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
		$CVthequeSubscriptions = Subscription::whereHas('offer', function($whereHas) {
				$whereHas->where('slug', '=', 'CVTHQ');
			})
			->where('end_date', '>', Carbon::now())
			->get();

		if($CVthequeSubscriptions->isNotEmpty()) {
			foreach($CVthequeSubscriptions as $CVthequeSubscription) {
				$sendMail = false;
				$endDate = Carbon::parse($CVthequeSubscription->end_date)->startOfDay();
				$now = Carbon::now()->startOfDay();
				$previousReminder = MailLog::where('user_id', '=', $CVthequeSubscription->user->id)
					->where('type', '=', 'reminder-CVtheque-subscription-expires-soon')
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
					if($now->diffInDays($endDate) == 5) {
						$sendMail = true;
						$reminderNumber = 1;
					}
				}

				if($sendMail) {
					$reminder = new MailLog;
					$reminder->user_id = $CVthequeSubscription->user->id;
					$reminder->type = 'reminder-CVtheque-subscription-expires-soon';
					$reminder->reminder_number = $reminderNumber;
					$reminder->save();
				}
			}
		}

		return Command::SUCCESS;
	}
}
