<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function program()
    {
    	return $this->belongsToMany('App\Program');
    }

    // public function answers()
    // {
    // 	return $this->hasMany('App\ProgramQuestion');
    // }
}
