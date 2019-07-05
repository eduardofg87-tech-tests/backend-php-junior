<?php

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('signin', 'AuthController@signin');
});

Route::group([
    'prefix'     => 'users',
    'middleware' => 'jwt.auth'
], function () {
    Route::post('/', 'UserController@store');
    Route::get('/{user}', 'UserController@show');
    Route::put('/{user}', 'UserController@update');
    Route::delete('/{user}', 'UserController@destroy');
});
