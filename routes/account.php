<?php

use Illuminate\Support\Facades\Route;


Route::post('edit', 'LoadController@editUser');
Route::post('updateDetails', 'LoadController@updateDetails');
Route::post('create', 'LoadController@createDetails');

Route::post('updateBusiness', 'LoadController@updateBusiness');
Route::post('accountBusiness', 'LoadController@accountBusiness');

Route::post('updateIntroducer', 'LoadController@updateIntroducer');
Route::post('accountIntroducer', 'LoadController@accountIntroducer');