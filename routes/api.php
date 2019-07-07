<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::delete('auth', 'AuthController@logout');
});

Route::resource('users', 'UsersController');
Route::post('auth', 'AuthController@login');
Route::get('ping', 'PingController@index');