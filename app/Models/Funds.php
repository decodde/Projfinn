<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    //
    //
    protected $table = 'funds';

    protected $fillable = ['userId', 'businessId', 'amount', 'description', 'address', 'type', 'existingLoan', 'certifyGuarantor', 'certifyDocuments', 'hasPaidReg', 'transactionId', 'progress', 'isOpen'];

    public function business(){
        return $this->hasOne('App\Models\Business', 'id', 'businessId')->first();
    }
    public function transaction(){
        return $this->hasOne('App\Models\Transaction', 'id', 'transactionId')->first();
    }
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'userId')->first();
    }

    public function documents(){
        return $this->hasMany('App\Models\Document', 'businessId', 'businessId')->get();
    }

    public function guarantors(){
        return $this->hasMany('App\Models\Guarantor', 'businessId', 'businessId')->get();
    }
}
