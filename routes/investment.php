<?php
use Illuminate\Support\Facades\Route;

Route::post('create', 'LoadController@create');
Route::post('transfer', 'LoadController@transfer');
Route::post('update', 'LoadController@update');
Route::get('success', 'LoadController@success');
Route::get('danger', 'LoadController@danger');
