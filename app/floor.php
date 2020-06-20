<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class floor extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'floor_id';
    protected $table = 'tbl_floor';

    public function rooms(){
        return $this->hasMany('App\Room');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }
}
