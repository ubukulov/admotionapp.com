<?php
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