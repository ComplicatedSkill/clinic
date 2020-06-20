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

    public function stockOnHand(){
        return $this->hasMany('App\StockOnHand');
    }

    public function ambulances(){
        return $this->hasMany('App/Ambulances');
    }

    public function chatAccounts(){
        return $this->hasMany('App/ChartAccount');
    }

    public function otherIncome(){
        return $this->hasMany('App/OtherIncome');
    }

    public function expense(){
        return $this->hasMany('App/Expense');
    }

    public function cashDeposit(){
        return $this->hasMany('App/CashDeposit');
    }

    public function appointment(){
        return $this->hasMany('App/Appointment');
    }

}
