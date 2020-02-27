<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'verify_web_hook'], function () {

    Route::namespace('Web')->group(function(){
        //route for verification
        //Route::get("/northern_breeze_chat_bot", "MessengerController@receive");

    });


});
Route::namespace('Web')->group(function(){
    //where Facebook sends messages to. No need to attach the middleware to this because the verification is via GET
    Route::get("/northern_breeze_chat_bot", "MessengerController@example");
});


