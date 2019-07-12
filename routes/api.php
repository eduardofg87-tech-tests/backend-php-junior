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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::prefix('v1')->group(function() {
    Route::get('/ping', function() {
        return response()->json(['message' => 'Servidor em funcionamento...']);
    });
    
    Route::prefix('auth')->group(function () {
        Route::post('login', 'API\AuthController@login');     
        Route::get('logout', 'API\AuthController@logout')->middleware('jwt.auth');
    });
    
    Route::apiResource('user', 'API\UserController');    
});
