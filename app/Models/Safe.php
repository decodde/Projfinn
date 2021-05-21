<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Safe extends Model
{
    //
    protected $table = 'saves';

    protected $fillable = ['userId', 'customerId', 'recipientId', 'totalAmount', 'availableAmount'];
}
