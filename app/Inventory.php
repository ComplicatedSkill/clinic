<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Inventory extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'inventory_id';
    protected $table = 'tbl_inventory';

    public function stockOnHand(){
        return $this->hasMany('App\StockOnHand');
    }
    public function categorys(){
        return $this->belongsTo('App\Category','category_id','category_id');
    }

    public function uoms(){
        return $this->belongsTo('App\UOM','uom_id','uom_id');
    }
}
