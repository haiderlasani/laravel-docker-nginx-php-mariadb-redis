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

//Route::namespace('API')->group(function () {
////    Route::post('login', 'UserController@login');
//    Route::post('register', 'UserController@register');
////    Route::group(['middleware' => 'auth:api'], function(){
////        Route::post('details', 'API\UserController@details');
////    });
//});

Route::group(['namespace' => 'API', 'prefix' => 'user'], function () {
    Route::post('register', 'UserController@register');
});