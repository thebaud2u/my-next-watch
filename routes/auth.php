<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{
	AuthenticatedSessionController,
	ConfirmablePasswordController,
	EmailVerificationNotificationController,
	EmailVerificationPromptController,
	NewPasswordController,
	PasswordController,
	PasswordResetLinkController,
	RegisteredUserController,
	VerifyEmailController
};

Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

Route::middleware('guest')->group(function () {
	Route::controller(RegisteredUserController::class)->group(function () {
		Route::get(__('routes.auth.register'), 'create')->name('register');
		Route::post('register', 'store')->name('register.store');
	});

	Route::controller(AuthenticatedSessionController::class)->group(function () {
		Route::get('login', 'create')->name('login');
		Route::post('login', 'store');
	});

	Route::controller(PasswordResetLinkController::class)->group(function () {
		Route::get('forgot-password', 'create')->name('password.request');
		Route::post('forgot-password', 'store')->name('password.email');
	});

	Route::controller(NewPasswordController::class)->group(function () {
		Route::get('reset-password/{token}', 'create')->name('password.reset');
		Route::post('reset-password', 'store')->name('password.store');
	});
});

Route::middleware('auth')->group(function () {
	Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');

	Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

	Route::controller(ConfirmablePasswordController::class)->group(function () {
		Route::get('confirm-password', 'show')->name('password.confirm');
		Route::post('confirm-password', 'store');
	});

	Route::put('password', [PasswordController::class, 'update'])->name('password.update');

	Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
