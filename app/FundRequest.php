<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundRequest extends Model
{
    //
    protected $table = 'fund_requests';
    protected $fillable = ['user_id', 'type', 'money', 'bank'];
    
    public function user() {
        return $this->belongsTo('App\User' , 'user_id');
    }

}
