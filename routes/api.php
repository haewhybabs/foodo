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
Route::get('/vendors','Vendors@index');
Route::get('/category/{id}','Category@selectedCategory');
Route::get('/vendor/{id}','Vendors@show');
Route::post('/customer-create','Customers@create');
Route::post('/upload','Stock@store');



Route::middleware('auth:api')->group(function () {

    Route::get('/details','AuthController@details');
    Route::get('/stock-categories','Stock@categoryList');
    Route::get('/stock-list','Stock@list');
    Route::post('/stock-upload','Stock@store');
    Route::post('/vendor-rating','Reviews@create');



});
