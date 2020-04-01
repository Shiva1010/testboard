<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Remsg extends Model
{
    use Notifiable;
    public $timestamps = false;

    protected  $fillable=[
        'boards_id','msg_id','remsg_user','remsg','create_time'
    ];

    public function msg(){
        return $this->belongsTo(Msg::class,'id');
    }

//    public function user()
//    {
//        return $this->belongsTo(Suser::class, 'suser_id');
//    }
//
}
