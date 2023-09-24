<?php
Route::get('delete/{bvnId}', 'LoadController@delete');

Route::post('create', 'LoadController@create');
Route::post('edit', 'LoadController@edit');
Route::post('valid', 'LoadController@valid');