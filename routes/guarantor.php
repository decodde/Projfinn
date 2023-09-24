<?php

Route::get('delete/{guarantorId}', 'LoadController@delete');

Route::post('create', 'LoadController@create');
Route::post('save', 'LoadController@save');