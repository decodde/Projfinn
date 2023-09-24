<?php


Route::get('delete/{documentId}', 'LoadController@delete');
Route::post('create', 'LoadController@create');

Route::get('int/delete/{documentId}', 'LoadController@introducer_delete');
Route::post('int/create', 'LoadController@introducer_create');