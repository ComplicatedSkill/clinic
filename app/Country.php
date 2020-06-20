<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Country extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'tbl_countries';
    protected $primaryKey = 'country_id';


    public function staffs(){
        return $this->hasMany('App\Staff');
    }
}
