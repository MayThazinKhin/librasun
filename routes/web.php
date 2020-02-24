<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'verify_web_hook'], function () {

    Route::name('web.')->namespace('Web')->group(function(){
        Route::name('example')->get('/','MessengerController@example');
    });


});
//route for verification
Route::get("/trivia", "MessengerController@receive")->middleware("verify_web_hook");

//where Facebook sends messages to. No need to attach the middleware to this because the verification is via GET
Route::post("/trivia", "MessengerController@receive");
