<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class busAccount extends Model
{
    //
    protected $table = 'bus_accounts';

    protected $fillable = ['userId', 'bankId', 'accountNumber'];

    public function bank() {
        return $this->hasOne('App\Models\Bank', 'id', 'bankId')->first();
    }
}
