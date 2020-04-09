<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Staff extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = '';
    protected $table = 'tbl_staff';

    public function staff(){
        return $this->hasOne('App\Schedule','staff_id','staff_id');
    }
}
