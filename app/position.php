<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    protected $table = 'tbl_position';

    public function users(){
        return $this->hasMany('App\User');
    }
}
