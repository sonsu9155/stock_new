<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawHistory extends Model
{
     //
     protected $table = 'withdraw_histories';
     protected $fillable = ['user_id', 'amount', 'bank', 'bank_name', 'status', 'before_amount'];
 
     public function user() {
         return $this->belongsTo('App\User' , 'user_id');
     }
}
