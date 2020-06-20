<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OtherIncome extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'other_income_id';
    protected $table = 'tbl_other_income';

    public function chartAccounts(){
        return $this->belongsTo('App\ChartAccount','chart_account_id','chart_account_id');
    }

    public function branchs(){
        return $this->belongsTo('App\branch','branch_id','branch_id');
    }
}
