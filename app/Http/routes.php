<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'LandingController@index');

    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/dashboard', 'DashboardController@index');


    Route::resource('order', 'OrderController');

});
