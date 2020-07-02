<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    //
    protected $table = 'portfolios';

    protected $fillable = ['name', 'description', 'returnInPer', 'trustee', 'riskLevel', 'size', 'amountPerUnit', 'managementFee', 'sizeRemaining', 'uniqueCode', 'isOpen'];
}
