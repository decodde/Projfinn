<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    //
    protected $table = 'lenderspreferences';

    protected $fillable = ['lenderId', 'lenderCategoryId'];

    public function category() {
        return $this->hasOne('App\Models\Category', 'id', 'categoryId');
    }
}
