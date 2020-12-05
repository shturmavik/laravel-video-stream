<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/movie/store', 'App\Http\Controllers\MovieController@store');
Route::post('/visitor/store', 'App\Http\Controllers\VisitorController@store');

//примеры в postman
Route::delete('/', 'App\Http\Controllers\SetSuccess@destroy');
Route::get('/{email_hash}/{section}', 'App\Http\Controllers\SetSuccess@show');
