<?php

use App\Http\Middleware\CheckAccess;
use App\Http\Controllers\StreamFFmpeg;
use App\Http\Controllers\PinController;
use App\Http\Controllers\RandomKey;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
    ->name('watchStream')->middleware([CheckAccess::class, 'signed']);

//access by PIN
Route::get('/{section}', [StreamFFmpeg::class, 'show'])
    ->name('watchStream')->middleware('pin');

//create video
Route::get('/{section}/create', [StreamFFmpeg::class, 'create']);

Route::get('/key_dir/{section}/random_key.key', [RandomKey::class, 'get']);

