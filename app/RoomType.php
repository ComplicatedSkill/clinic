<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoomType extends Model
{

    public $timestamps = false;
    use Notifiable;
    protected $table = 'tbl_room_type';
    protected $primaryKey = 'room_type_id';

    public function rooms(){
        return $this->hasMany('App\Room');
    }

}
