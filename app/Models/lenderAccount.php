<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lenderAccount extends Model
{
    //
    protected $table = 'lender_accounts';

    protected $fillable = ['userId', 'bankId', 'bvn', 'accountNumber'];
}
