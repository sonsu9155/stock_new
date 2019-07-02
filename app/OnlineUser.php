<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineUser extends Model
{
    //
    protected $table = 'online_users';
    protected $fillable = ['user_id', 'platform', 'ipaddress', 'entry_time', 'depature_time'];
    
    public function user() {
        return $this->belongsTo('App\User' , 'user_id');
    }
}
