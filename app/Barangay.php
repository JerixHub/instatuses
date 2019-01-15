<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    public function users()
    {
    	return $this->belongsToMany('App\Users');
    }

    public function programs()
    {
    	return $this->belongsToMany('App\Program');
    }
}