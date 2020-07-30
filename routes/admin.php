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

Route::get('/overview', 'PageController@index');
Route::get('/user', 'PageController@user');
Route::get('/referrals', 'PageController@referrals');
Route::get('/business', 'PageController@businesses');
Route::get('/introducer', 'PageController@introducers');
Route::get('/introducer/{id}', 'PageController@introducer');
Route::get('/search', 'PageController@searchDashboard');
Route::get('/business/{id}', 'PageController@business');
Route::get('/investor', 'PageController@investors');
Route::get('/investor/{id}', 'PageController@investor');
Route::get('/funding', 'PageController@funds');
Route::get('/funding/{id}', 'PageController@fund');
Route::get('/investment', 'PageController@investments');
Route::get('/transaction', 'PageController@transactions');
Route::get('/portfolio', 'PageController@portfolios');
Route::get('/bvn', 'PageController@bvnValidate');
Route::get('/transfers', 'PageController@transfers');


Route::post('/transact', 'LoadController@adminConfirm');
Route::post('/status', 'LoadController@fundStatus');
Route::post('/transfer', 'LoadController@verifyTransfer');
Route::get('/user/delete/{id}', 'LoadController@deleteUser');
