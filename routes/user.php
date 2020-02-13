<?php
# Маршруты для пользователей
Route::group(['middleware' => 'auth', 'prefix' => 'user'], function(){
    Route::get('cabinet', 'UserController@cabinet')->name('user.cabinet');
    Route::post('/profile', 'UserController@profile')->name('user.profile');
    Route::post('/payment', 'UserController@payment')->name('user.payment');
    Route::get('/payment', 'UserController@payment_form')->name('user.payment_form');
    Route::get('/gifts', 'UserController@gifts')->name('user.gifts');
});