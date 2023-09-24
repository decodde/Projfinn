<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loanRates extends Model
{
    //
    protected $table = 'loan_rates';

    protected $fillable = ['portfolioId', 'three', 'six', 'nine', 'twelve'];
}