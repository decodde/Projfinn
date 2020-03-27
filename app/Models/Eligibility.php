<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    //
    protected $table = 'eligibilities';

    protected $fillable = ['businessId', 'registrationStatus', 'yearsOfRunning', 'lastBusinessRevenue', 'accountVerifiable', 'score', 'slug'];

    public function business() {
        return $this->hasOne('App\Models\Business', 'id', 'businessId');
    }
}
