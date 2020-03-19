<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Good extends Authenticatable
{
    use Notifiable;

    protected  $fillable=[
        'user_name','password','api_token','create_time'
    ];

    protected $hidden=[
        'password',
    ];
}
