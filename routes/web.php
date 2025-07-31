<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsentController;
use App\Http\Controllers\ImportExportController;
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
})
    ->middleware('auth')
    ->name('home');

Route::prefix('customers')->controller(CustomerController::class)
    ->name('customers.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/export-customer-csv', [ImportExportController::class, 'exportCustomerCsv'])->name('exportCustomerCsv');
        Route::get('/export-point-history-csv', [ImportExportController::class, 'exportPointHistoryCsv'])->name('exportPointHistoryCsv');

        Route::get('/{id}/card-create', 'createCard')->name('createCard');
        Route::post('/{id}/card-store', 'storeCard')->name('storeCard');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');

        Route::get('/{id}/points', 'points')->name('points');
        Route::post('/{id}/add-points', 'addPoints')->name('addPoints');

        Route::get('/{id}/card-edit', 'editCard')->name('editCard');
        Route::put('/{id}/card-update', 'updateCard')->name('updateCard');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::prefix('salons')->controller(SalonController::class)
    ->name('salons.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/export-salon-csv', [ImportExportController::class, 'exportSalonCsv'])->name('exportSalonCsv');

        Route::get('/setting-point', 'pointSetting')->name('pointSetting');
        Route::post('/import-point', [ImportExportController::class, 'importSalonCsv'])->name('importPoint');

        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/modal-select', 'modalSelect')->name('modalSelect');
        Route::patch('/{id}/toggle-status', 'toggleStatus')->name('toggleStatus');

        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');

        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::prefix('users')->controller(UserController::class)
    ->name('users.')
    ->middleware('auth')
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
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/history', 'history')->name('history');
        Route::get('/export-consent-history-csv', [ImportExportController::class, 'exportConsentHistoryCsv'])->name('exportConsentHistoryCsv');

        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::patch('/{id}/toggle-status', 'toggleStatus')->name('toggleStatus');

        Route::get('/{id}', 'show')->name('show');
    });
