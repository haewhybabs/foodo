<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','web\HomeController@index');
Route::get('/category/{id}','web\HomeController@category');
Route::get('{name}/{id}/{vendor}', 'web\HomeController@vendorDetails')->where('name', '[A-Za-z]+');
Route::get('/login','web\HomeController@login')->name('login');
Route::post('/login','web\HomeController@loginPost');
Route::get('/register','web\HomeController@register');
Route::post('/register','web\HomeController@registerPost');
Route::get('/logout','web\HomeController@logout');
Route::get('/vendor-register','web\HomeController@vendorRegister');
Route::post('/vendor-register','web\HomeController@vendorRegisterPost');
Route::get('/vendor-account','web\VendorController@index');
Route::post('/stock-category','web\VendorController@stockCategory');
Route::post('/stock-create','web\VendorController@stockCreate');
Route::get('/stock-status/{id}/{status}','web\VendorController@stockStatus');
Route::get('/add-to-cart/{id}','web\CartController@add');
Route::get('/remove-cart/{id}','web\CartController@remove');
Route::post('/update-cart','web\CartController@update');
Route::get('/checkout','web\CheckoutController@index');
Route::post('/add-address','web\CheckoutController@addAddress');
Route::get('/deliver-here/{id}','web\CheckoutController@deliverHere');
Route::get('/remove-address/{id}','web\CheckoutController@removeAddress');
Route::get('/change-address/{id}','web\CheckoutController@changeAddress');
Route::post('/transaction','web\CheckoutController@transaction');
Route::get('/vendor-delivery/{id}','web\VendorController@vendorDelivery');
Route::get('/vendor-search','web\HomeController@vendorSearch');
Route::get('/vendor-rating','web\HomeController@vendorRating');
Route::post('/vendor-review','web\HomeController@vendorReview');
Route::get('/like-review','web\HomeController@likeReview');
Route::get('/region-filter/{id}','web\HomeController@regionFilter');
Route::get('/payment-verification','web\checkoutController@paymentVerification');
Route::get('/user-account','web\UserAccount@index');
Route::get('/delivery-confirm/{id}','web\UserAccount@confirmDelivery');


Route::get('/test','web\CartController@test');

