<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Deals\DealController;
use App\Http\Controllers\Contacts\ContactController;

Route::get('/', function () {
    return view('components.home.home', [
        'contacts' => (new ContactController())->zohoModule()->getRecords(1, 30),
        'deals' => (new DealController())->zohoModule()->getRecords(1, 30),
    ]);
})->name('index');

require_once __DIR__ . '/contacts.php';
require_once __DIR__ . '/deals.php';
