<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth', 'dashboard']);

Route::group(['middleware' => ['auth', 'dashboard']], function () {
    Route::resource('user', 'UserController', ['except' => ['show']])->middleware('admin');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('company', 'CompanyController@index')->name('company.index');
    Route::get('company/create', 'CompanyController@create')->name('company.create');
    Route::post('company', 'CompanyController@store')->name('company.store');
    Route::get('company/{company}/edit', 'CompanyController@edit')->name('company.edit');
    Route::put('company/{company}', 'CompanyController@update')->name('company.update');
    Route::delete('company/{company}/destroy', 'CompanyController@destroy')->name('company.destroy');

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

    Route::get('offer', 'OffersController@index')->name('offer.index');
    Route::delete('offer/{offer}/destroy', 'OffersController@destroy')->name('offer.destroy');

});


Route::get('request/{request}/map', 'MapController@map')->name('map');
Route::get('googlemap/direction', 'MapController@direction');
