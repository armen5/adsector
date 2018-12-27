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


Auth::routes();

Route::get('/', 'PagesController@index')->name('landing');
Route::get('/features', 'PagesController@features')->name('features');
Route::get('/about', 'PagesController@about')->name('about');
//Route::post('/register','Auth\RegisterController@validator')->name('register');

Route::get('/checkout',"PaymentController@checkout")->name('checkout')->middleware('auth');

Route::get('/message',function(){
	return view('paypal.message');
});
// route for processing payment
Route::post('paypal', 'PaymentController@payWithpaypal');
// route for check status of the payment
Route::get('status', 'PaymentController@getPaymentStatus');
Route::any('paypal_return', 'PaypalController@return');

// Route::get('create_paypal_plan', 'PaypalController@create_plan');
Route::get('/subscribe/paypal', 'PaypalController@paypalRedirect');
Route::get('/subscribe/paypal/return', 'PaypalController@paypalReturn');
Route::get('/account/payment/paypal/cancel','PaypalController@paymentCancel');


Route::group(['middleware' => ['isPaymentVerified']], function () {
	Route::get('/dashboard', 'AppController@index')->name('dashboard');
	Route::get('/account/member','AppController@accountMemberView');	
});