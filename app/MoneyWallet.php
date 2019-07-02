<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyWallet extends Model
{
    //
    //
    protected $table = 'money_wallets';
    protected $fillable = ['before_amount', 'after_amount'];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
