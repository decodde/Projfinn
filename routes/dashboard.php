<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'business'], function() {
    Route::get('/', 'BusController@dashboard');
    Route::get('/eligibility/score', 'BusController@score');
    Route::get('/document', 'BusController@documents');
    Route::get('/funds', 'BusController@funds');
    Route::get('/save', 'BusController@save');
    Route::get('/fund/{id}', 'BusController@funds_one');
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

Route::group(['middleware' => 'introducer', 'prefix' => 'e'], function() {
    Route::get('/', 'IntController@dashboard');
    Route::get('/document', 'IntController@documents');
    Route::get('/businesses', 'IntController@businesses');
    Route::get('/save', 'IntController@save');
    Route::get('/settings', 'IntController@settings');
});
