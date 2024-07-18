<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\MailLog;
use App\Models\User;

class ReminderNoConnectApplicantCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'reminder:no-connect-applicant';

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
		$applicants = User::whereHas('user_types', function($whereHas) {
				$whereHas->where('active', '=', 1);
			})
			->where('last_logon', '<=', Carbon::now()->format('Y-m-d').' %')
			->get();

		if($applicants->isNotEmpty()) {
			foreach($applicants as $applicant) {
				$sendMail = false;
				$lastLogon = Carbon::parse($applicant->last_logon)->startOfDay();
				$now = Carbon::now()->startOfDay();
				$previousReminder = MailLog::where('user_id', '=', $applicant->id)
					->where('type', '=', 'reminder-no-connect-applicant')
					->latest('created_at')
					->first();

				if($previousReminder) {
					$lastReminderDate = Carbon::parse($previousReminder->created_at)->startOfDay();

					if($previousReminder->reminder_number == 1 && $lastReminderDate->diffInDays($now) == 5) {
						$sendMail = true;
						$reminderNumber = 2;
					}
					else if($previousReminder->reminder_number == 2 && $lastReminderDate->diffInDays($now) == 2) {
						$sendMail = true;
						$reminderNumber = 3;

						$disableApplicantStatus = $applicant->user_types()->where('active', '=', 1)->first();
						$disableApplicantStatus->active = 0;
						$disableApplicantStatus->save();
					}
				}
				else {
					if($now->diffInDays($lastLogon) == 44) {
						$sendMail = true;
						$reminderNumber = 1;
					}
				}

				if($sendMail) {
					$reminder = new MailLog;
					$reminder->user_id = $applicant->id;
					$reminder->type = 'reminder-no-connect-applicant';
					$reminder->reminder_number = $reminderNumber;
					$reminder->save();
				}
			}
		}

		return Command::SUCCESS;
	}
}
