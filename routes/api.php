<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Transaction\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/login', 'AuthController@login'); 

////////////////////////////  USER    /////////////////////////////////

Route::get('/v1/user/profile', 'AuthController@user_details');

Route::get('/v1/user/details' , 'UserController@userdetails');

Route::get('/v1/user/balance', 'UserController@user_balance');


///////////////////////////   TRANSACTIONS  ////////////////////////////////
Route::post('/v1/transactions/buy' , 'TransactionController@buy');

Route::post('/v1/transactions/withdraw' , 'TransactionController@transfer');

