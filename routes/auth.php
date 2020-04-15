<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/login', 'PageController@login');
Route::get('/lender', 'PageController@lender');
Route::get('/business', 'PageController@eligibilityTest');

Route::post('/login', 'LoadController@login');

