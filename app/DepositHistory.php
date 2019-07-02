<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositHistory extends Model
{
    //
    protected $table = 'deposit_histories';
    protected $fillable = ['user_id', 'amount', 'type', 'before_amount', 'status'];

    public function user() {
        return $this->belongsTo('App\User' , 'user_id');
    }
}
