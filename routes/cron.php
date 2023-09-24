<?php

Route::get('fund-reminder', 'BusinessController@fundReminder');
Route::get('saving-plans', 'BusinessController@savingsPlan');
Route::get('transfer-invest', 'InvestorController@transferInvestment');
Route::get('verify_sub', 'InvestorController@verifySub');