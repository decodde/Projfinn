<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    //
    protected $table = 'savings';

    protected $fillable = ['email', 'name', 'amount', 'interval', 'months', 'monthsPaid', 'reference', 'nextPayment', 'plan_code', 'isCompleted', 'sub_code', 'email_token'];
}
