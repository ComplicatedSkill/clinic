<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'patient_id';
    protected $table = 'tbl_patient';

    public function appointments(){
        return $this->hasMany('App\Appointment',);
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

    public function departments(){
        return $this->belongsTo('App\department','department_id','department_id');
    }

    public function countries(){
        return $this->belongsTo('App\Country', 'country_id','country_id');
    }


}
