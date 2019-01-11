<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    public function barangay()
    {
    	return $this->belongsTo('App\Barangay');
    }

    public function program()
    {
    	return $this->belongsTo('App\Program');
    }
}
