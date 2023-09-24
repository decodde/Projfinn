<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    //
    protected $table = 'reserves';

    protected $fillable = ['email', 'name', 'amount', 'interval', 'duration', 'durationPassed', 'reference', 'durationPaid', 'nextPayment', 'auth_code', 'isCompleted', 'isStarted'];
    
    public function user() {
        return $this->hasOne('App\Models\User', 'email', 'email')->first();
    }
}