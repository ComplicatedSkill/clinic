<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StockOnHand extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'stock_on_hand_id';
    protected $table = 'tbl_stock_on_hand';

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

    public function inventorys(){
        return $this->belongsTo('App\Inventory', 'inventory_id','inventory_id');
    }

    public function warehouses(){
        return $this->belongsTo('App\Warehouse','warehouse_id','warehouse_id');
    }
}
