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
Route::get('logout', 'IndexController@logout')->name('logout');
Route::get('partners', 'IndexController@partners')->name('partners');
Route::get('partner/{id}', 'IndexController@partner')->name('partner.show');
Route::get('/{alias}/{id}', 'CategoryController@show')->name('category.show');
Route::post('/paybox/pay', 'IndexController@paybox')->name('paybox.pay');
Route::get('/payment', 'IndexController@payment_success');
Route::get('/payment/order/{id}', 'IndexController@payment_status')->name('payment_status');
Route::get('/send-me-test-cms/{phone}', 'IndexController@send_me_test_sms');