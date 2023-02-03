<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function (): void {
    Route::post('auth/login', 'API\AuthController@login')->name('auth.login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/logout', 'API\AuthController@logout')->name('auth.logout');

        Route::apiResource('clients', 'API\ClientsController');

        Route::get('payments', 'API\PaymentsController@index')->name('payments.index');
        Route::post('payments/{id}/paid', 'API\PaymentsController@paid')->name('payments.paid');
        Route::post('payments/{id}/canceled', 'API\PaymentsController@canceled')->name('payments.canceled');

        Route::get('/dictionary/payment-statuses', 'API\DictionaryController@paymentStatuses')->name('dictionary.payment-statuses');
    });
});
