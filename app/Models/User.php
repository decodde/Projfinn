<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'type', 'avatar', 'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at'
    ];

    public function business()
    {
        return $this->hasOne('App\Models\Business', 'userId', 'id')->first();
    }

    public function investor()
    {
        return $this->hasOne('App\Models\Lender', 'userId', 'id')->get();
    }
}
