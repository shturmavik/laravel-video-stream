<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetSuccess;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\MovieController;

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::post('/movie/store', [MovieController::class, 'store']);
Route::post('/visitor/store', [VisitorController::class, 'store']);

//примеры в postman
Route::delete('/', [SetSuccess::class, 'destroy']);
Route::get('/{email_hash}/{section}', [SetSuccess::class, 'show']);
