<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\MailLog;
use App\Models\Company;

class MailUpgradeCompanyOfferCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'mail:upgrade-company-offer';

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
		$companiesStandard = Company::whereHas('offer', function($whereHas) {
				$whereHas->where('slug', '=', 'PGEENTSTD');
			})
			->where('state', '=', 2)
			->get();

		if($companiesStandard->isNotEmpty()) {
			foreach($companiesStandard as $company) {
				$sendMail = false;
				$now = Carbon::now()->startOfDay();
				$previousReminder = MailLog::where('user_id', '=', $company->user->id)
					->where('type', '=', 'mail-upgrade-company-standard-offer')
					->latest('created_at')
					->first();

				if($previousReminder) {
					$lastReminderDate = Carbon::parse($previousReminder->created_at)->startOfDay();

					if($lastReminderDate->diffInMonths($now) == 6) $sendMail = true;
				}

				if($sendMail) {
					$reminder = new MailLog;
					$reminder->user_id = $company->user->id;
					$reminder->type = 'mail-upgrade-company-standard-offer';
					$reminder->reminder_number = 1;
					$reminder->save();
				}
			}
		}

		/*
		A décommenter à partir de Janvier 2024
		$companiesMarqueEmployeur = Company::whereHas('offer', function($whereHas) {
				$whereHas->where('slug', '=', 'PGEENTEM');
			})
			->where('state', '=', 2)
			->get();

		if($companiesMarqueEmployeur->isNotEmpty()) {
			foreach($companiesMarqueEmployeur as $company) {
				$sendMail = false;
				$now = Carbon::now()->startOfDay();
				$previousReminder = MailLog::where('user_id', '=', $company->user->id)
					->where('type', '=', 'mail-upgrade-company-marque-employeur-offer')
					->latest('created_at')
					->first();

				if($previousReminder) {
					$lastReminderDate = Carbon::parse($previousReminder->created_at)->startOfDay();

					if($lastReminderDate->diffInMonths($now) == 6) $sendMail = true;
				}

				if($sendMail) {
					$reminder = new MailLog;
					$reminder->user_id = $company->user->id;
					$reminder->type = 'mail-upgrade-company-marque-employeur-offer';
					$reminder->reminder_number = 1;
					$reminder->save();
				}
			}
		}
		*/

		return Command::SUCCESS;
	}
}
