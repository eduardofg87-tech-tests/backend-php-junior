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

Route::group([
    'middleware' => ['api', 'jwt.verify'],
], function ($router) {
    Route::resource('/clients', 'ClientsController');
    Route::get('me', 'UsersController@me');
    Route::get('logout', 'UsersController@logout');
    Route::get('refresh', 'UsersController@refresh');
});

Route::post('register', 'UsersController@register');
Route::post('auth', 'UsersController@login');
Route::post('ping', 'HealthController@health');
