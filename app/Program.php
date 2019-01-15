<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function questions()
    {
    	return $this->belongsToMany('App\Question');
    }

    public function barangays()
    {
    	return $this->belongsToMany('App\Barangay');
    }

    public function answers()
    {
        return $this->hasMany('App\ProgramQuestion');
    }
}
