<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stash extends Model
{
    //
    protected $table = 'stashes';

    protected $fillable = ['investorId', 'customerId', 'totalAmount', 'availableAmount'];
}
