<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranxConfirm extends Model
{
    //
    protected $table = 'tranx_confirms';

    protected $fillable = ['email', 'portfolioId','fundId', 'amount', 'reference', 'isCompleted', 'type', 'months'];

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'userId')->first();
    }
}
