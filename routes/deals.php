<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Deals\DealController;

Route::name('deals.')->prefix('deals')->group(function () {
    //// The list of all Deals
    //Route::get('/', [DealController::class, 'index'])
    //    ->name('index');

    // Get form for add/create Deal
    Route::get('create', [DealController::class, 'create'])
        ->name('create');

    // Store created Deal
    Route::post('create/store', [DealController::class, 'store'])
        ->name('store');

    //Route::get('{deal}', [DealController::class, 'show'])
    //    ->name('show')

    //Route::get('{deal}/edit', [DealController::class, 'edit'])
    //    ->name('edit')
});
