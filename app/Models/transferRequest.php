<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transferRequest extends Model
{
    //
    protected $table = 'transfer_requests';

    protected $fillable = ['investorId', 'amount', 'message', 'transfer_code', 'reference', 'otpConfirmed'];

    public function investor(){
        return $this->hasOne('App\Models\Lender', 'id', 'investorId')->first();
    }
    public function user($userId){
        return User::where('id', $userId)->first();
    }
}
