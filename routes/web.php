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

Route::get('/', 'IndexController@welcome')->name('home');

# Partners
Route::get('partners', 'IndexController@partners')->name('partners');
Route::get('partner/{id}', 'IndexController@partner')->name('partner.show');

# Categories
Route::get('/kategoriya/{alias}', 'CategoryController@show')->name('category.show');

# Payment
Route::post('/paybox/pay', 'IndexController@paybox')->name('paybox.pay');
Route::get('/payment', 'IndexController@payment_success');
Route::get('/payment/order/{id}', 'IndexController@payment_status')->name('payment_status');

# Test
Route::get('/send-me-test-cms/{phone}/test', 'IndexController@send_me_test_sms');

# Stocks
Route::get('/stocks/{id}', 'IndexController@stock_show')->name('stock.show');

# Auth && Register
Route::get('login', 'AuthController@login')->name('login');
Route::get('register', 'AuthController@register')->name('register');
Route::post('registration', 'AuthController@registration')->name('registration');
Route::post('authenticate', 'AuthController@authenticate')->name('authenticate');
Route::get('logout', 'AuthController@logout')->name('logout');