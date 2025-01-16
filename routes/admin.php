<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ {
	AdminController,
	AuthController,
	DashboardController,
	UserController,
	SettingController,
	WatchController
};

/*
|--------------------------------------------------------------------------
| Back-office Routes
|--------------------------------------------------------------------------
*/

/** '/admin' prefix group */
Route::prefix('/back-office')->name('admin.')->group(function () {
	Route::controller(AuthController::class)->group(function () {
		Route::get('/', 'check')->name('check'); // admin.check
		Route::get('/login', 'login')->name('login'); // admin.login
		Route::post('/authenticate', 'authenticate')->name('authenticate'); // admin.authenticate
	});

	/** Admin authenticated routes */
	Route::middleware(['auth:admin'])->group(function () {
		Route::controller(AuthController::class)->group(function () {
			Route::get('/log-as-user/{user}', 'logAsUser')->name('log-as-user'); // admin.log-as-user
			Route::post('/logout', 'logout')->name('logout'); // admin.logout
		});

		Route::controller(AdminController::class)->group(function () {
			Route::get('/admins', 'index')->name('admins'); // admin.admins
		});

		Route::controller(DashboardController::class)->group(function () {
			Route::get('/dashboard', 'index')->name('dashboard'); // admin.dashboard
		});

		Route::controller(SettingController::class)->prefix('/settings')->name('settings.')->group(function() {
			Route::get('/', 'index')->name('index'); // admin.settings.index
		});

		Route::controller(UserController::class)->group(function () {
			Route::get('/users', 'index')->name('users'); // admin.users
		});

		Route::controller(WatchController::class)->group(function () {
			Route::get('/watches', 'index')->name('watches'); // admin.watches
		});
	});
});
