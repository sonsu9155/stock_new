<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LivevideoMessage extends Model
{
    //
    protected $table = 'livevideo_messages';
    protected $fillable = ['user_id', 'type', 'toUid', 'message', 'platform'];

    public function user() {
        return $this->belongsTo('App\User' , 'user_id');
    }
}
