<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Suser extends Authenticatable
{
    use Notifiable;

    protected  $fillable=[
        'boards_id','msg_user','msg','create_time'
    ];

}
