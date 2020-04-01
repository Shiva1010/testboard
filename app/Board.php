<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Board extends Model
{
    use Notifiable;
    public $timestamps = false;

    protected  $fillable=[
        'author','content','create_time'
    ];


    public function msgs()
    {
        return $this->hasMany(Msg::class,'boards_id');
//        SOJ: 更優雅的寫法
//        return $this->hasMany(Msg::class,'boards_id')->with('remsgs');
    }

    public function goods()
    {
        return $this->hasMany(Good::class,'boards_id');
    }

}
