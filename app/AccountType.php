<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AccountType extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $primaryKey = 'account_type_id';
    protected $table = 'tbl_account_type';

    public function chatAccounts(){
        return $this->hasMany('App\ChartAccount');
    }

}
