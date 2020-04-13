<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BVN extends Model
{
    //
    protected $table = 'bvns';

    protected $fillable = ['number', 'businessId'];

    public function business() {
        return $this->hasOne('App\Models\Business', 'id', 'businessId');
    }
}
