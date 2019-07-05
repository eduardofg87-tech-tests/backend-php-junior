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
    'middleware' => 'auth:api'
], function () {
    Route::post('/', 'UserController@store');
});
