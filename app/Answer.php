<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function program_question()
    {
    	return $this->belongsTo('App\ProgramQuestion');
    }
}
