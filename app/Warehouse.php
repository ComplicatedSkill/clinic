<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Warehouse extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'warehouse_id';
    protected $table = 'tbl_warehouse';

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

    public function stockOnHands(){
        return $this->hasMany('App\StockOnHand');
    }
}
