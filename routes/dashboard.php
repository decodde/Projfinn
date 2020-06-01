<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'business'], function() {
    Route::get('/', 'BusController@dashboard');
    Route::get('/eligibility/score', 'BusController@score');
    Route::get('/document', 'BusController@documents');
    Route::get('/funds', 'BusController@funds');
    Route::get('/settings', 'BusController@settings');
});

Route::group(['middleware' => 'investor', 'prefix' => 'i'], function() {
    Route::get('/', 'PageController@i_dashboard');
    Route::get('/stash', 'PageController@i_dashboard_stash');
    Route::get('/share', 'PageController@i_dashboard_referral');
    Route::get('/settings', 'PageController@i_dashboard_settings');
    Route::get('/investments', 'PageController@i_dashboard_investment');
    Route::get('/investment/{id}', 'PageController@i_dashboard_oneInvestment');
});
