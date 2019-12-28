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

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});

Route::get('categories','Category@index');

Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');
Route::post('/vendor-create','Vendors@create');
Route::get('/vendor-list','Vendors@index');
Route::get('/show-vendor/{id}','Vendors@show');
Route::post('/customer-create','Customers@create');


Route::middleware('auth:api')->group(function () {
    Route::get('/details','AuthController@details');


});
