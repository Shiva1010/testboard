<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Remsg;


class Msg extends Model
{
    use Notifiable;
    public $timestamps = false;

    protected  $fillable=[
        'boards_id','msg_user','msg','create_time'
    ];


    public function board(){
        return $this->belongsTo(Board::class,'id');
    }

    public function remsgs(){
        return $this->hasMany(Remsg::class,'msg_id');
    }

}