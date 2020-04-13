<?php

Route::get('/', 'PageController@dashboard');
Route::get('/eligibility/score', 'PageController@score');
Route::get('/document', 'PageController@documents');
