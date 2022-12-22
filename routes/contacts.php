<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::name('contacts.')->prefix('contacts')->group(function () {
    // The list of all Contacts
    Route::get('/', [ContactController::class, 'index'])
        ->name('index');

    Route::get('create', [ContactController::class, 'create'])
        ->name('create');

    Route::post('create/store', [ContactController::class, 'store'])
        ->name('store');

    //Route::get('{contact}', [ContactController::class, 'show'])
    //    ->name('show')

    //Route::get('{contact}/edit', [ContactController::class, 'edit'])
    //    ->name('edit')
});
