<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    //
    protected $table = 'lectures';
    protected $fillable = ['lecture_name', 'playing_date', 'playing_time', 'teacher_name', 'description', 'location'];    
   
}
