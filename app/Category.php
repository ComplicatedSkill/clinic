<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category';

    public function inventorys(){
        return $this->hasMany('App\Inventory');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }
}
