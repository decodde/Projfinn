<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    //
    protected $table = 'transactions';

    protected $fillable = ['investorId', 'businessId', 'userId', 'amount', 'type', 'message', 'status', 'reference'];
}
