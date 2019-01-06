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

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function () {
    
    Route::get('user', 'API\AuthController@user');
    Route::post('logout', 'API\AuthController@logout');

    Route::get('trip','API\TripController@index');
    Route::post('trip','API\TripController@store');
    Route::get('trip/{name}','API\TripController@show');
});