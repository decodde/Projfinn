<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'business'], function() {
    Route::get('/', 'PageController@dashboard');
    Route::get('/eligibility/score', 'PageController@score');
    Route::get('/document', 'PageController@documents');
});



Route::group(['middleware' => 'investor', 'prefix' => 'i'], function() {
    Route::get('/', 'PageController@i_dashboard');
    Route::get('/stash', 'PageController@i_dashboard_stash');
    Route::get('/share', 'PageController@i_dashboard_referral');
    Route::get('/settings', 'PageController@i_dashboard_settings');
    Route::get('/investments', 'PageController@i_dashboard_investment');
    Route::get('/investment', 'PageController@i_dashboard_oneInvestment');
});
