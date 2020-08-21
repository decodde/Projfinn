<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fundPayment extends Model
{
    //
    protected $table = 'fund_payments';

    protected $fillable = ['userId', 'businessId', 'fundId', 'total_amount', 'months', 'months_left', 'amountPerMonth', 'nextPayment', 'isCompleted', 'auth_code'];
}
