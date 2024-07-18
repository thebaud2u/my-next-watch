<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		// Archivage des annonces, des abonnements thèques et des pages entreprises expirées
		$schedule->command('artisan "check:permissions"')->dailyAt('07:00');
		$schedule->command('artisan "check:publication"')->dailyAt('07:00');

		// Relances candidat
		$schedule->command('artisan "reminder:no-connect-applicant"')->dailyAt('07:00');

		// Relances recruteurs
		// $schedule->command('artisan "mail:upgrade-or-buy-cvtheque-access"')->dailyAt('07:00');
		$schedule->command('artisan "reminder:post-expires-soon"')->dailyAt('07:00');
		// $schedule->command('artisan "reminder:CVtheque-subscription-expires-soon"')->dailyAt('07:00');

		/*
			A décommenter à partir de Janvier 2024
			$schedule->command('artisan "reminder:company-marque-employeur-expires-soon"')->dailyAt('07:00');
			$schedule->command('artisan "reminder:company-marque-employeur-plus-expires-soon"')->dailyAt('07:00');
		*/
		// $schedule->command('artisan "mail:upgrade-company-offer"')->dailyAt('07:00');

		// Refresh
		$schedule->command('artisan "refresh:posts"')->dailyAt('07:00');
		$schedule->command('artisan "refresh:companies"')->dailyAt('07:00');

		// envoi de mail des résumés des annonces ajoutée aujourd'hui
		$schedule->command('artisan "mail:post_published_today_premium"')->dailyAt('23:59');
		$schedule->command('artisan "mail:post_published_today_premium_plus"')->dailyAt('23:59');
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__.'/Commands');

		require base_path('routes/console.php');
	}
}
