<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Web')->group(function(){
    Route::get("/branches", "MessengerController@getBranches");

    Route::get("/currency_value","MessengerController@getCurrencyValue");

    Route::get("/booking","MessengerController@booking");


});


