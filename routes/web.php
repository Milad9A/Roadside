<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth', 'dashboard']);

Route::group(['middleware' => ['auth', 'dashboard']], function () {
    Route::get('table-list', function () {
        return view('pages.table_list');
    })->name('table');

    Route::get('notifications', function () {
        return view('pages.notifications');
    })->name('notifications');

    Route::get('rtl-support', function () {
        return view('pages.language');
    })->name('language');

    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');
});

Route::group(['middleware' => ['auth', 'dashboard']], function () {
    Route::resource('user', 'UserController', ['except' => ['show']])->middleware('admin');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('service', 'ServiceController@index')->name('service.index');
    Route::get('service/create', 'ServiceController@create')->name('service.create');
    Route::post('service', 'ServiceController@store')->name('service.store');
    Route::get('service/{service}/edit', 'ServiceController@edit')->name('service.edit');
    Route::put('service/{service}', 'ServiceController@update')->name('service.update');
    Route::delete('service/{service}/destroy', 'ServiceController@destroy')->name('service.destroy');

    Route::post('service/{service}/sub', 'SubServiceController@store')->name('service.sub.store');
    Route::get('service/sub/{sub}/edit', 'SubServiceController@edit')->name('service.sub.edit');
    Route::put('service/sub/{sub}', 'SubServiceController@update')->name('service.sub.update');
    Route::delete('service/sub/{sub}/destroy', 'SubServiceController@destroy')->name('service.sub.destroy');

    Route::get('request', 'RequestsController@index')->name('request.index');
    Route::get('request/create', 'RequestsController@create')->name('request.create');
    Route::post('request', 'RequestsController@store')->name('request.store');
    Route::get('request/{request}/edit', 'RequestsController@edit')->name('request.edit');
    Route::put('request/{request}', 'RequestsController@update')->name('request.update');
    Route::delete('request/{request}/destroy', 'RequestsController@destroy')->name('request.destroy');
});



Route::get('googlemap', 'MapController@map')->name('map');
Route::get('googlemap/direction', 'MapController@direction');
