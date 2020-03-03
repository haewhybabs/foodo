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

// Route::get('/',function(){
//     return view('Emails.registration');
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
Route::get('/stock-status/{id}','web\VendorController@stockStatus');
Route::post('/add-to-cart','web\CartController@add');
Route::post('/remove-cart','web\CartController@remove');
Route::get('/update-cart','web\CartController@update');
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
Route::post('/favourite','web\HomeController@favourite');
Route::get('/region-filter/{id}','web\HomeController@regionFilter');
Route::post('/loadstock','web\HomeController@vendorStock');

Route::post('/payment-verification','web\CheckoutController@paymentVerification');
Route::get('/user-account','web\UserAccount@index');
Route::get('/delivery-confirm/{id}','web\UserAccount@confirmDelivery');
Route::get('/thankyou/{id}','web\UserAccount@thankyou');
Route::post('/user-edit-profile','web\UserAccount@editProfile');
Route::post('/credit-wallet','web\UserAccount@creditWallet');
Route::post('/wallet-payment-verification','web\UserAccount@walletVerify');

Route::post('/transfer-update','web\VendorController@transferAccountUpdate');
Route::post('/payout','web\VendorController@payout');
Route::post('/edit-stock','web\VendorController@editStock');
Route::post('/loadmore','web\HomeController@loadmore');
Route::post('/newsletter','web\HomeController@newsletter');
Route::post('/protein-soup','web\CartController@proteinSoup');
Route::get('/forgot-password','web\HomeController@resetPassword')->name('reset-password');
Route::get('/reset-password/{password}','web\HomeController@confirmResetPassword');
Route::get('/final-password-reset','web\HomeController@finalPasswordReset');

Route::get('/test','web\CartController@test');

