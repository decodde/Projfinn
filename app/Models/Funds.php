<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    //
    //
    protected $table = 'funds';

    protected $fillable = ['userId', 'businessId', 'amount', 'description', 'hasPaidReg', 'transactionId', 'progress', 'isOpen'];

    public function business(){
        return $this->hasOne('App\Models\Business', 'id', 'businessId')->first();
    }
    public function transaction(){
        return $this->hasOne('App\Models\Transaction', 'id', 'transactionId')->first();
    }
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'userId')->first();
    }

    public function document(){
        return $this->hasOne('App\Models\Document', 'businessId', 'businessId')->first();
    }
}
