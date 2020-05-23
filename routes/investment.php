<?php
use Illuminate\Support\Facades\Route;

Route::post('create', 'LoadController@create');
Route::post('transfer', 'LoadController@transfer');
Route::get('success', 'LoadController@success');
Route::get('danger', 'LoadController@danger');
