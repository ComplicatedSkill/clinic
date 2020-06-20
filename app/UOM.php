<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 5/7/2020
 * Time: 8:14 AM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UOM extends Model
{
    protected $table='tbl_uom';
    protected $primaryKey='uom_id';
    public $timestamps = false;
    use Notifiable;

    public function inventorys(){
        return $this->hasMany('App\Inventory');
    }
}
