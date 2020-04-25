<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    //
    protected $table = 'referrals';

    protected $fillable = ['userId', 'refererId', 'hasSignUp', 'hasPayed'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'userId')->first();
    }
}
