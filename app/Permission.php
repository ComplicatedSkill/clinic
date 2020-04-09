<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Permission extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'permission_id';
    protected $table = 'tbl_user_permission';

    public function users(){
        return $this->belongsTo('App\User','user_id','user_id');
    }
}
