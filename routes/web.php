<?php

use App\Http\Middleware\CheckAccess;
use App\Http\Controllers\StreamFFmpeg;
use App\Http\Controllers\PinController;
use App\Http\Controllers\RandomKey;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin'],
    function () {
        Voyager::routes();
    }
);

Route::view('/', 'index');

Route::view(
    'pin/create',
    'create'
)->name('pin.create');

Route::post('pin/store', PinController::class)->name('pin.store')->middleware('throttle:3,1');

//access by URL with sign
Route::get('/{section}', [StreamFFmpeg::class, 'show'])
    ->name('watchStream')->middleware(CheckAccess::class);

//access by PIN
Route::get('/{section}', [StreamFFmpeg::class, 'show'])
    ->name('watchStream')->middleware('pin');

//create video
Route::post('/{section}/create', [StreamFFmpeg::class, 'store'])->middleware('restrictIp');

Route::get('/key_dir/{section}/random_key.key', [RandomKey::class, 'get']);

