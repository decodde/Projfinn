<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LenderCategory extends Model
{
    //
    protected $table = 'lender_categories';

    protected $fillable = ['name', 'description'];
}
