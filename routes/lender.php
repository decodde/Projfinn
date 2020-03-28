<?php
use Illuminate\Support\Facades\Route;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::post('/', 'LoadController@create');
