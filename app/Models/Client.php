<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserMongoDb as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $guard = 'client';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'insertion', 'last_name', 'initials', 'bday', 'country', 'city', 'street', 'email', 'password', 'phone', 'privacy_permission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
