<?php
use Illuminate\Support\Facades\Route;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::post('/', 'LoadController@create');
Route::post('/invite', 'LoadController@createInvite');
Route::get('/invite/delete/{inviteId}', 'LoadController@deleteInvite');

Route::post('/save', 'LoadController@create_reserve');