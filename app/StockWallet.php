<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockWallet extends Model
{
    //
    protected $table = 'stock_wallets';
    protected $fillable = ['before_amount', 'after_amount'];
    
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
