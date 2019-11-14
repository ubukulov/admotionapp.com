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

# Маршруты для пользователей
Route::group(['prefix' => 'user'], function(){
    Route::get('login', 'UserController@login')->name('user.login');
    Route::post('authenticate', 'UserController@authenticate')->name('user.authenticate');
    Route::get('register', 'UserController@register')->name('user.register');
    Route::post('registration', 'UserController@registration')->name('user.registration');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('cabinet', 'UserController@cabinet')->name('user.cabinet');
    });
});

# Маршруты для партнеров
Route::group(['prefix' => 'partner'], function(){
    Route::get('login', 'PartnerController@login')->name('partner.login');
    Route::post('authenticate', 'PartnerController@authenticate')->name('partner.authenticate');
    Route::get('register', 'PartnerController@register')->name('partner.register');
    Route::post('registration', 'PartnerController@registration')->name('partner.registration');

    Route::group(['middleware' => 'partner'], function(){
        Route::get('cabinet', 'PartnerController@cabinet')->name('partner.cabinet');
        Route::get('profile', 'PartnerController@editProfile')->name('partner.edit.profile');
        Route::post('profile/{id}/update', 'PartnerController@updateProfile')->name('partner.update.profile');
        Route::post('change/image', 'PartnerController@changeImage')->name('partner.change.image');
        Route::get('gift/create', 'PartnerController@createGift')->name('create.gift');
        Route::post('gift/store', 'PartnerController@storeGift')->name('store.gift');
    });
});