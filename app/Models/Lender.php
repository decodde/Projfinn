<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'country', 'userId', 'logo'];

    public function profile() {
        return $this->hasOne('App\Models\User', 'id', 'userId');
    }

    public function preferences($lenderId) {
        return Preference::where('lenderId', $lenderId)->first();
    }

    public function balance() {
        return $this->hasOne('App\Models\Credit', 'lenderId', 'id');
    }

    public function transactions() {
        return $this->hasMany('App\Models\Transaction', 'lenderId', 'id');
    }

    public function matches() {
        return $this->hasMany('App\Models\Match', 'lenderId', 'id');
    }

    public function purge($lenderId) {
        //delete the transactions they are associated with
        Transaction::where('lenderId', $lenderId)->delete();

        //delete all match histories
        Match::where('lenderId', $lenderId)->delete();

        //delete their credit balance
        Credit::where('lenderId', $lenderId)->delete();

        //delete their loan preference
        Preference::where('lenderId', $lenderId)->delete();

        return true;
    }
}
