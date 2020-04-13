<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    //
    protected $fillable = ['businessId', 'name', 'phone', 'email', 'relationship', 'bvn'];

    public function business()
    {
        return $this->hasOne('App\Models\Business', 'id', 'businessId');
    }
}
