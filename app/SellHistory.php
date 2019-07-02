<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellHistory extends Model
{
    //
    protected $table = 'sell_histories';
    protected $fillable = ['user_id', 'stock_type_id', 'buy_cost', 'buy_fee', 'sell_fee', 'state_fee', 'buy_time',  'amount', 'sell_cost', 'method', 'before_amount', 'save_fee','fee'];
    
    public function stockType()
    {
        return $this->belongsTo('App\StockType' , 'stock_type_id');
    }

    public function user() {
        return $this->belongsTo('App\User' , 'user_id');
    }
   
}
