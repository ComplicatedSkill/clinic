<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class branch extends Model
{
    public $timestamps = false;
    use Notifiable;

    protected $primaryKey = 'branch_id';
    protected $table = 'tbl_branch';

    public function users(){
        return $this->hasMany('App\User');
    }
    public function departments(){
        return $this->hasMany('App\department');
    }

}
