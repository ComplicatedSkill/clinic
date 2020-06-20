<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'appointment_id';
    protected $table = 'tbl_appointment';

    public function departments(){
       return $this->belongsTo('App\department','department_id','department_id');
    }

    public function staffs(){
        return $this->belongsTo('App\Staff','staff_id','staff_id');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

    public function patients(){
        return $this->belongsTo('App\Patient','patient_id','patient_id');
    }
}
