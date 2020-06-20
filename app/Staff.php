<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Staff extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'staff_id';
    protected $table = 'tbl_staff';

    public function schedules(){
        return $this->hasOne('App\Schedule','staff_id','staff_id');
    }

    public function ambulances(){
        return $this->hasMany('App\Ambulances');
    }

    public function positons(){
        return $this->belongsTo('App\position','position_id','position_id');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

    public function departments(){
        return $this->belongsTo('App\department','department_id','department_id');
    }

    public function positions(){
        return $this->belongsTo('App\position','position_id','position_id');
    }

    public function countries(){
        return $this->belongsTo('App\Country','country_id','country_id');
    }
}
