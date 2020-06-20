<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Withdrawal extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'cash_withdrawal_id';
    protected $table = 'tbl_cash_withdrawal';

    public function chartAccounts(){
        return $this->belongsTo('App\ChartAccount','chart_account_id','chart_account_id');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }
}
