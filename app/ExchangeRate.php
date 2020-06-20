<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ExchangeRate extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'exchange_rate_id';
    protected $table = 'tbl_exchange_rate';

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

}
