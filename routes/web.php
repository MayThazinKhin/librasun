<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Web')->group(function(){
    Route::get('save_transaction','TransactionController@saveTransaction');
});


