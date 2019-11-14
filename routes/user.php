<?php
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