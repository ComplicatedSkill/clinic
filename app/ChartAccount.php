<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ChartAccount extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'chart_account_id';
    protected $table = 'tbl_chart_account';
    public $incrementing = false;

    protected $keyType = 'string';

    public function accountTypes(){
        return $this->belongsTo('App\AccountType','account_type_id','account_type_id');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }

    public function otherIncomes(){
        return $this->hasMany('App\OtherIncome');
    }

    public function expense(){
        return $this->hasMany('App\Expense');
    }

    public function cashDeposit(){
        return $this->hasMany('App\CashDeposit');
    }

}
