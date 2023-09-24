<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class introducerDocument extends Model
{
    //
    protected $table = 'introducer_documents';

    protected $fillable = ['introducerId', 'type', 'file'];

    public function introducer() {
        return $this->hasOne('App\Models\Introducer', 'id', 'introducerId');
    }
}