<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyHistory extends Model
{
    //
    protected $table = 'buy_histories';
    protected $fillable = ['user_id', 'stock_type_id', 'amount', 'cost', 'method', 'before_amount', 'fee'];
    
    public function stockType()
    {
        return $this->belongsTo('App\StockType' , 'stock_type_id');
    }

    public function user() {
        return $this->belongsTo('App\User' , 'user_id');
    }

    
}
