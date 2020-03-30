<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulances extends Model
{
    public $incrementing = false;
    protected $table = 'tbl_ambulance';
    protected $primaryKey = 'ambulance_id';
    protected $fillable=['branch_id','ambulance_id','ambulance_name','license_plate','staff_id','status','user_create','date_create','user_update','date_update'];
}
