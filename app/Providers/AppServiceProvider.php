<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		$this->app['request']->server->set('HTTPS', 'on');
		URL::forceScheme('https');

		Str::macro('slugify', function ($string) {
			$string = mb_strtolower($string, 'UTF-8');
			$string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
			$string = preg_replace('/[^a-z0-9]+/', '-', $string);
			return trim($string, '-');
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{

	}
}
