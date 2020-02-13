<?php
# Маршруты для партнеров
Route::group(['middleware' => 'partner', 'namespace' => 'Partner', 'prefix' => 'partner'], function(){
    Route::get('/logout', 'PartnerController@logout')->name('partner.logout');
    Route::get('cabinet', 'PartnerController@cabinet')->name('partner.cabinet');
    Route::get('profile', 'PartnerController@editProfile')->name('partner.edit.profile');
    Route::post('profile/{id}/update', 'PartnerController@updateProfile')->name('partner.update.profile');
    Route::post('change/image', 'PartnerController@changeImage')->name('partner.change.image');
    Route::get('gift/create', 'PartnerController@createGift')->name('create.gift');
    Route::post('gift/store', 'PartnerController@storeGift')->name('store.gift');
    Route::get('/orders', 'PartnerController@orders')->name('partner.orders');

    # Stocks
    Route::get('/stocks', 'StockController@index')->name('partner.stocks');
    Route::get('/stocks/create', 'StockController@create')->name('partner.stock.create');
    Route::post('/stocks/store', 'StockController@store')->name('partner.stock.store');
});