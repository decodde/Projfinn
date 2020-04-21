<?php

use Illuminate\Support\Facades\Route;

Route::post('/buy', 'LoadController@buy');
Route::get('/confirm', 'LoadController@confirm');
