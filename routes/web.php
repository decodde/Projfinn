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

Route::group(['namespace' => 'Index'], function() {
    Route::get('/', 'PageController@index');
    Route::get('/invest', 'PageController@about');
    Route::get('/contact', 'PageController@contact');
    Route::post('/contact', 'PageController@contactUs');
    Route::get('/faq', 'PageController@faq');
    Route::get('/women', 'PageController@women');
     Route::get('/autokash', 'PageController@autokash');
    Route::get('/wbc', 'PageController@wbc');
    Route::get('/sign-up', 'PageController@signup');
});

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/logout', 'LoadController@logout');
});

