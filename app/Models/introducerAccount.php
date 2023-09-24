<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class introducerAccount extends Model
{
    //
    protected $table = 'introducer_accounts';

    protected $fillable = ['userId', 'bankId', 'bvn', 'accountNumber'];

    public function bank() {
        return $this->hasOne('App\Models\Bank', 'id', 'bankId')->first();
    }
}