<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});



require_once __DIR__ . '/contacts.php';
//require_once __DIR__ . '/deals.php';