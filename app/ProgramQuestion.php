<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramQuestion extends Model
{
    protected $table = 'program_question';

    public function program()
    {
    	return $this->hasOne('App\Program', 'id', 'program_id');
    }

    public function question()
    {
    	return $this->hasOne('App\Question', 'id', 'question_id');
    }

    public function answers()
    {
    	return $this->hasMany('App\Answer');
    }
}
