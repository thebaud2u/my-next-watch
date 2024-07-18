<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['allowIP'])->group(function () {
	Route::post('orders', [OrderController::class, 'store']);
});
