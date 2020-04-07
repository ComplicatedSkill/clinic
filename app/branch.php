<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    protected $table = 'tbl_branch';

    public function users(){
        return $this->hasMany('App\User');
    }
    public function departments(){
        return $this->hasMany('App\department');
    }

}
