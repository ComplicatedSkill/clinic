<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bed extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'bed_id';
    protected $table = 'tbl_bed';

    public function rooms(){
        return $this->belongsTo('App\Room','room_id','room_id');
    }
}
