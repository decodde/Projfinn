<?php

use Illuminate\Support\Facades\Route;


Route::post('edit', 'LoadController@editUser');
Route::post('updateDetails', 'LoadController@updateDetails');
Route::post('create', 'LoadController@createDetails');
