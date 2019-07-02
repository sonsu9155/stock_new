<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockType extends Model
{
    //
    protected $table = 'stock_types';
    protected $fillable = ['option', 'code', 'cn_name'];

    public function buyHistories() {
        return $this->hasMany('App\Comment', 'stock_type_id');
    }

    public function sellHistories() {
        return $this->hasMany('App\Comment', 'stock_type_id');
    }
    
}
