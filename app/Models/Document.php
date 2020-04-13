<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $table = 'documents';

    protected $fillable = ['businessId', 'type', 'file'];

    public function business() {
        return $this->hasOne('App\Models\Business', 'id', 'businessId');
    }
}
