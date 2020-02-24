<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'verify_web_hook'], function () {

    Route::name('web.')->namespace('Web')->group(function(){
        Route::name('example')->get('/','MessengerController@example');
    });


});
