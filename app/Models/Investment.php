<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    protected $table = 'investments';

    protected $fillable = ['userId', 'investorId', 'portfolioId', 'unitsBought', 'amount', 'datePurchased', 'paymentMethod', 'transactionId'];
}
