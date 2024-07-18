<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ {
	AuthController,
	DashboardController,
	SettingController
};

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


/** -------------------------------------------------------------------- */
/** Admin auth */

/** OAuth2 client auth (SocialiteProviders/Microsoft-Azure) */
/** (Callback route specified in MS 365 - Azure) */
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback']);

/** -------------------------------------------------------------------- */
/** Back-office routes */

/** '/admin' prefix group */
Route::prefix('/back-office')->name('admin.')->group(function () {

	/** Public '/' route => check if admin is authenticated */
	Route::get('/', [AuthController::class, 'check'])->name('check'); // admin.check

	/** Admin authenticated routes */
	Route::middleware(['auth:admin'])->group(function () {
		Route::controller(AuthController::class)->group(function () {
			Route::get('/log-as-user/{user}', 'logAsUser')->name('log-as-user'); // admin.log-as-user
			Route::post('/logout', 'logout')->name('logout'); // admin.logout
		});

		Route::controller(DashboardController::class)->group(function () {
			Route::get('/dashboard', 'index')->name('dashboard'); // admin.dashboard
		});

		Route::controller(SettingController::class)->prefix('/settings')->name('settings.')->group(function() {
			Route::get('/', 'index')->name('index'); // admin.settings.index
		});
	});
});
