<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class department extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'department_id';
    protected $table = 'tbl_department';

    public function users(){
        return $this->hasMany('App\User');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

    public function appointments(){
        return $this->hasMany('App\Appointment');
    }
}
