<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Web')->group(function(){
    Route::get("/northern_breeze_chat_bot", "MessengerController@example");

    Route::get("/currency_value","MessengerController@getCurrencyValue");


});


