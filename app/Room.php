<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 5/5/2020
 * Time: 6:09 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'tbl_room';
    protected $primaryKey = 'room_id';

    public function departments(){
        return $this->belongsTo('App\department','department_id','department_id');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

    public function roomtypes(){
        return $this->belongsTo('App\RoomType','room_type_id','room_type_id');
    }

    public function floors(){
        return $this->belongsTo('App\Floor','floor_id','floor_id');
    }

}
