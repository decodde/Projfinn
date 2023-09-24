<?php

use Illuminate\Support\Facades\Route;

Route::post('/buy', 'LoadController@buy');
Route::post('/repayFund', 'LoadController@repayFund');
Route::get('/confirm', 'LoadController@confirm');
Route::post('/transfer', 'LoadController@transfer');
Route::post('/transferBusiness', 'LoadController@transferBusiness');
Route::post('/commissionFee', 'LoadController@commissionFee');