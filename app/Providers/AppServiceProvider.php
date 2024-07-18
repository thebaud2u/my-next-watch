<?php

namespace App\Providers;

// use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Contracts\Factory;

use App\Channels\OfficeMailChannel;

use App\Services\SsoProvider;

use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app['request']->server->set('HTTPS', 'on');
		URL::forceScheme('https');

		$socialite = $this->app->make(Factory::class);

		$socialite->extend('sso', function () use ($socialite) {
			$config = config('services.sso');

			return $socialite->buildProvider(SsoProvider::class, $config);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if (!$this->app->environment('production')) {
			$this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
			$this->app->register(TelescopeServiceProvider::class);
		}
	}

}
