<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introducer extends Model
{
    //
    protected $table = 'introducers';

    protected $fillable = ['userId', 'name', 'email', 'phone', 'address', 'slug'];

    public function documents() {
        return $this->hasMany('App\Models\introducerDocument', 'introducerId', 'id');
    }
    public function account() {
        return $this->hasOne('App\Models\introducerAccount', 'userId', 'userId');
    }

    public function owner() {
        return $this->hasOne('App\Models\User', 'id', 'userId');
    }
}
