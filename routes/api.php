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

Route::get('/ping', 'PingController');

Route::group(['prefix' => 'auth'], function () {
    Route::post('/', 'AuthController@signin');
});

Route::resource('users', 'UserController')->except([
    'edit', 'create'
])->middleware('jwt.auth');
