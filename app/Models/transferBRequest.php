<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transferBRequest extends Model
{
    //
    protected $table = 'transfer_b_requests';

    protected $fillable = ['userId', 'amount', 'message', 'transfer_code', 'reference', 'otpConfirmed'];

    public function user($userId){
        return User::where('id', $userId)->first();
    }
}
