<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Schedule extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'id';
    protected $table = 'tbl_schedule';

    
    public function staffs(){
        return $this->hasOne('App\Staff','staff_id','staff_id');
    }
}
