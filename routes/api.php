<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function (): void {
    Route::get('login', 'API\AuthController@login')->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('clients', 'API\ClientsController');
        Route::apiResource('payments', 'API\PaymentsController')->except(['update', 'destroy']);
        Route::post('payments/{payment}/paid', 'API\PaymentsController@paid')->name('payments.paid');
        Route::post('payments/{payment}/canceled', 'API\PaymentsController@canceled')->name('payments.canceled');
    });
});
