<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Front\{
	BrandController,
	CollectionController,
	ContactController,
	HomeController,
	LegalPageController,
	FinderController,
	WatchController
};
use App\Http\Controllers\Front\Space\{
	FavoriteController,
	ProfileController,
};

/* ===================================================================== *
 * Register / SSO routes
 * ===================================================================== */

require __DIR__ . '/auth.php';

/* ===================================================================== *
 * Admin (app back-office)
 * ===================================================================== */

require __DIR__ . '/admin.php';

/* ===================================================================== *
 * public routes
 * ===================================================================== */
Route::get('/redirect-to-login', function (Request $request) {
	$from = $request->query('from', '/');

	$parsedFrom = parse_url($from);
	$parsedApp  = parse_url(config('app.url'));

	$isInternal = !isset($parsedFrom['host']) || $parsedFrom['host'] === $parsedApp['host'];

	session(['url.intended' => $isInternal ? $from : '/']);

	return redirect()->route('login');
})->name('redirect.to.login');

Route::controller(BrandController::class)->name('brand.')->group(function () {
	Route::get('/brand/{brand:slug}', 'show')->name('show');
});

Route::controller(CollectionController::class)->name('collection.')->group(function () {
	Route::get('/collection/{collection:slug}', 'show')->name('show');
});

Route::controller(ContactController::class)->group(function() {
	Route::get(__('routes.contact.index'), 'index')->name('contact');
	Route::post(__('routes.contact.submit'), 'submit')->name('contact.submit');
});

Route::controller(FinderController::class)->group(function () {
	Route::get('/lets-find-my-next-watch', 'index')->name('lets-find-my-next-watch');
});

Route::controller(HomeController::class)->group(function() {
	Route::get(__('routes.home.index'), 'index')->name('home');
	Route::get(__('routes.home.offer'), 'indexOffer')->name('home.offer');
	Route::get('/faq', 'faq')->name('faq');
});

Route::name('legal-pages.')->group(function() {
	Route::controller(LegalPageController::class)->group(function() {
		Route::get(__('routes.legal-pages.cookies'), 'cookies')->name('cookies');
		Route::get(__('routes.legal-pages.about-us'), 'aboutUs')->name('about-us');
	});
});

Route::controller(WatchController::class)->name('watch.')->group(function () {
	Route::get('/watch/{watch:slug}', 'show')->name('show');
});

/* ===================================================================== *
 * User authenticated routes
 * ===================================================================== */
Route::middleware(['auth:web'])->group(function() {
	Route::get('/documents/{filename}', function ($filename) {
		$disk = Storage::disk('private');
		$basePath = realpath($disk->path(''));
		$resolvedPath = realpath($disk->path($filename));

		if(!$resolvedPath || !str_starts_with($resolvedPath, $basePath . DIRECTORY_SEPARATOR)) abort(404, 'Fichier introuvable');

		return response()->file($resolvedPath);
	})->where('filename', '[a-zA-Z0-9_\-\.\/]+')->name('documents.show');

	Route::prefix(__('routes.space'))->name('space.')->group(function() { // 'space.*'
		Route::controller(FavoriteController::class)->name('favorites.')->group(function() {
			Route::get(__('routes.space.favorites.my-favorites'), 'index')->name('my-favorites'); // space.favorites.my-favorites
		});

		Route::controller(ProfileController::class)->name('profile.')->group(function() {
			Route::get(__('routes.space.profile.dashboard'), 'dashboard')->name('dashboard'); // space.profile.dashboard
			Route::get(__('routes.space.profile.my-profile'), 'myProfile')->name('my-profile'); // space.profile.my-profile
			Route::get(__('routes.space.profile.my-orders'), 'myOrders')->name('my-orders'); // space.profile.my-orders
			Route::get(__('routes.space.profile.complete-my-profile'), 'completeMyProfile')->name('complete-my-profile'); // space.profile.complete-my-profile
			Route::get(__('routes.space.profile.settings'), 'settings')->name('settings'); // space.profile.settings
			Route::get(__('routes.space.profile.settings.change-password'), 'changePassword')->name('settings.change-password'); // space.profile.settings.change-password
			Route::post(__('routes.space.profile.settings.update-password'), 'updatePassword')->name('settings.update-password'); // space.profile.settings.update-password
			Route::post(__('routes.space.profile.settings.delete-account'), 'deleteAccount')->name('settings.delete-account'); // space.profile.settings.delete-account
			Route::get(__('routes.space.profile.my-notifications'), 'myNotifications')->name('my-notifications'); // space.profile.my-notifications
		});
	});
});
