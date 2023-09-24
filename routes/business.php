<?php
use Illuminate\Support\Facades\Route;


if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::post('/createBusiness', 'LoadController@business');
Route::post('/save', 'LoadController@create_reserve');