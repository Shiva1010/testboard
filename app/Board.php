<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Suser extends Authenticatable
{
    use Notifiable;

    protected  $fillable=[
        'author','content','create_time'
    ];

}
