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
Route::get('/savings', 'PageController@reserves');
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
Route::get('/portfolio/{id}', 'PageController@portfolio');
Route::get('/bvn', 'PageController@bvnValidate');
Route::get('/transfers', 'PageController@transfers');
Route::get('/payout', 'PageController@payOut');


Route::post('/transact', 'LoadController@adminConfirm');
Route::post('/credit', 'LoadController@creditStash');
Route::post('/status', 'LoadController@fundStatus');
Route::get('/transfer/{id}/{investorId}', 'LoadController@verifyTransfer');
Route::get('/user/delete/{id}', 'LoadController@deleteUser');
Route::get('/liquidate/{id}', 'LoadController@liquidate');
Route::get('/portf/close/{id}', 'LoadController@closePortfolio');
Route::get('/portf/open/{id}', 'LoadController@openPortfolio');
Route::get('/confirmFund/{id}/{email}', 'LoadController@confirmFund');
Route::post('/portf/topup/{id}', 'LoadController@topUpPortfolio');
Route::post('/portf/create', 'LoadController@createPortfolio');
