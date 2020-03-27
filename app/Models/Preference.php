<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    //
    protected $table = 'lendersPreferences';

    protected $fillable = ['lenderId', 'categoryIds', 'turnover', 'band', 'otherRequirements', 'rate', 'year', 'duration'];

    public function category() {
        return $this->hasOne('App\Models\Category', 'id', 'categoryId');
    }
}
