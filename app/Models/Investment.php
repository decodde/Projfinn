<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    protected $table = 'investments';

    protected $fillable = ['userId', 'investorId', 'portfolioId', 'unitsBought', 'amount', 'datePurchased', 'paymentMethod', 'transactionId'];

    public function transaction() {
        return $this->hasOne('App\Models\Transaction', 'id', 'transactionId')->first();
    }

    public function portfolio(){
        return $this->hasOne('App\Models\Portfolio', 'id', 'portfolioId')->first();
    }
}
