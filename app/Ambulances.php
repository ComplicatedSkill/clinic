<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ambulances extends Model
{  public $timestamps = false;
    use Notifiable;
    protected $table = 'tbl_ambulance';
    protected $primaryKey = 'ambulance_id';

    public function staffs(){
        return $this->belongsTo('App\Staff','staff_id','staff_id');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id', 'branch_id');
    }
}
