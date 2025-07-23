<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('login')->controller(AuthController::class)
    ->group(function () {
        Route::get('/', 'login')->name('login');
        Route::post('/', 'postLogin')->name('postLogin');
    });

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::prefix('customers')->controller(CustomerController::class)
    ->name('customers.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/{id}/card-create', 'createCard')->name('createCard');
        Route::post('/', 'storeCard')->name('storeCard');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');

        Route::get('/{id}/points', 'points')->name('points');
        Route::post('/points', 'addPoints')->name('addPoints');

        Route::get('/{id}/card-edit', 'editCard')->name('editCard');
        Route::put('/{id}/card-update', 'updateCard')->name('updateCard');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::prefix('salons')->controller(SalonController::class)
    ->name('salons.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/setting-point', 'pointSetting')->name('pointSetting');
        // Route::post('/points', 'addPoints')->name('addPoints');

        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::prefix('users')->controller(UserController::class)
    ->name('users.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::prefix('consents')->controller(ConsentController::class)
    ->name('consents.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/history', 'history')->name('history');

        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/{id}', 'show')->name('show');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });
