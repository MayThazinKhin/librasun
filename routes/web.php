<?php

use Illuminate\Support\Facades\Route;


Route::namespace('Web')->group(function() {
    Route::get('save_transaction', 'TransactionController@saveTransaction');
    Route::get('transaction', 'TransactionController@index');
    Route::get('pos', 'TransactionController@pos');
    Route::get('print', 'TransactionController@printReceipt');

});


