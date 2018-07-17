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


Auth::routes();

Route::group(['middleware' => ['auth', 'web']], function () {
    Route::get('/', function () {
        return redirect()->home();
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('street', 'StreetController');
    Route::resource('region', 'RegionController');
    Route::resource('car', 'CarController');
    Route::group(['prefix' => 'car'], function () {
        Route::post('rent-car/{car}', 'CarController@rentCar')->name('car.rentCar');
    });
    Route::resource('notification', 'NotificationController');
    Route::group(['prefix' => 'notification'], function () {
        Route::post('change-status/{notification}', 'NotificationController@changeStatus')->name('notification.changeStatus');
        Route::post('cancel-status/{notification}', 'NotificationController@cancelStatus')->name('notification.cancelStatus');
        Route::get('assign/{notification}', 'NotificationController@assignWorker')->name('notification.assign.worker');
        Route::post('assign/{notification}', 'NotificationController@storeWorker')->name('notification.store.worker');
        Route::get('invoice/{notification}', 'NotificationController@createInvoice')->name('notification.create.invoice');
        Route::post('invoice/{notification}', 'NotificationController@storeInvoice')->name('notification.store.invoice');
    });
    Route::resource('invoice', 'InvoiceController', ['only' => ['index', 'destroy']]);
    Route::group(['prefix' => 'invoice'], function () {
        Route::get('generate/{invoice}', 'InvoiceController@generateInvoice')->name('invoice.generate');
    });
    Route::resource('user', 'UserController');
});
