<?php

Route::middleware('throttle:200,1')->group(function () {
    Route::get('company', 'Mono\WebController@company');
});

Route::middleware(['auth:api', 'throttle:5000,1'])->group(function () {
    Route::post('document', 'Mono\DocumentController@store')->name('document.store');
    Route::post('media', 'Mono\MediaController@store')->name('media.store');
});

Route::middleware(['api', 'auth:api'])->group(function () {
    // monoland
    Route::get('user', 'Mono\WebController@user')->name('user.info');
    Route::get('menus', 'Mono\WebController@menus')->name('user.menu');
    Route::put('profile', 'Mono\WebController@profile')->name('user.profile');
    Route::put('password', 'Mono\WebController@password')->name('change.password');
    Route::get('authent/combo', 'Mono\AuthentController@combo');
    Route::post('users/bulkdelete', 'Mono\UserController@bulkdelete');

    Route::resource('users', 'Mono\UserController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('setting', 'Mono\SettingController')->only(['index', 'store', 'update', 'show', 'destroy']);
    Route::resource('client', 'Mono\ClientController')->only(['index', 'store', 'update', 'destroy']);
    Route::post('document/bulkdelete', 'Mono\DocumentController@bulkdelete');
    Route::resource('document', 'Mono\DocumentController')->only(['index', 'update', 'destroy']);

    // combo
    Route::get('province/{province}/regency/combo', 'Apps\RegencyController@combo');
    Route::get('regency/{regency}/district/combo', 'Apps\DistrictController@combo');

    // fetch
    Route::get('venue/{venue}/monetize/fetch', 'Apps\MonetizeController@fetch');
    Route::get('venue/{venue}/pricelist/fetch', 'Apps\PricelistController@fetch');

    // other
    Route::get('item/{item}/prices', 'Apps\ItemController@prices');
    Route::get('item/{item}/pricelists', 'Apps\ItemController@pricelists');

    // application
    Route::resource('item', 'Apps\ItemController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('segment', 'Apps\SegmentController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('province', 'Apps\ProvinceController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('province.regency', 'Apps\RegencyController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('regency.district', 'Apps\DistrictController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('venue', 'Apps\VenueController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('venue.employee', 'Apps\OfficeController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('venue.monetize', 'Apps\MonetizeController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('venue.pricelist', 'Apps\PricelistController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('employee', 'Apps\EmployeeController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('employee.marketing', 'Apps\MarketingController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('customer', 'Apps\CustomerController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('reservation', 'Apps\ReservationController')->only(['index', 'store', 'update', 'destroy']);
});
