<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'business'], function() {
    Route::get('/', 'PageController@dashboard');
    Route::get('/eligibility/score', 'PageController@score');
    Route::get('/document', 'PageController@documents');
});



Route::group(['middleware' => 'investor', 'prefix' => 'i'], function() {
    Route::get('/', 'PageController@i_dashboard');
});
