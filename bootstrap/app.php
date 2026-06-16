<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthenticateAnyGuard;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\ValidateSignature;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Article;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Response;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		web: __DIR__.'/../routes/web.php',
		api: file_exists(__DIR__.'/../routes/api.php') ? __DIR__.'/../routes/api.php' : null,
		commands: file_exists(__DIR__.'/../routes/console.php') ? __DIR__.'/../routes/console.php' : null,
		channels: file_exists(__DIR__.'/../routes/channels.php') ? __DIR__.'/../routes/channels.php' : null,
		health: '/up',
		then: function (): void {
			RateLimiter::for('api', function (Request $request) {
				return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
			});

			Route::bind('activity', fn ($value) => Activity::findBySlug($value, 'fr'));
			Route::bind('activityCategory', fn ($value) => ActivityCategory::findBySlug($value, 'fr'));
			Route::bind('article', fn ($value) => Article::findBySlug($value));
			Route::bind('company', fn ($value) => Company::findBySlug($value));
			Route::bind('offer', fn ($value) => Offer::findBySlug($value));
			Route::bind('post', fn ($value) => Post::findBySlug($value));
			Route::bind('postType', fn ($value) => PostType::findBySlug($value));
			Route::bind('response', fn ($value) => Response::find($value));
			Route::bind('user', fn ($value) => User::findBySlug($value));
		},
	)
	->withMiddleware(function (Middleware $middleware): void {
		$middleware->statefulApi();
		$middleware->throttleApi();

		$middleware->alias([
			'auth' => Authenticate::class,
			'auth.any' => AuthenticateAnyGuard::class,
			'guest' => RedirectIfAuthenticated::class,
			'signed' => ValidateSignature::class,
			'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
			'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
		]);

		$middleware->validateCsrfTokens(except: [
			'https://job.tema-transport-logistique.com/api/synch-last-posts',
			'/api/synch-last-posts',
			'synchLastPosts',
			'/back-office/faqs/upload',
			'swyp/*',
		]);
	})
	->withExceptions(function (Exceptions $exceptions): void {
		//
	})
	->create();
