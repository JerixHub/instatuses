<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Barangay;
use App\User;
use Auth;

class ProgramController extends Controller
{
    public function index($program, $barangay, $user)
    {
    	$current_program = Program::find($program);
    	$current_barangay = Barangay::find($barangay);
    	$current_user = User::find($user);
    	$programs = Program::all();
    	$is_admin = false;
    	if(empty($current_user)){
    		abort(403);
    	}else{
    		if($current_user->id != Auth::user()->id){
	    		abort(403);
	    	}

	    	if($current_user->is_admin){
	    		$is_admin = true;
	    	}else{
	    		if($current_barangay->id != Auth::user()->barangay->id){
		    		abort(403);
		    	}
	    	}
    	}

    	return view('admin.programs.index', compact('current_program','current_barangay','current_user', 'programs', 'is_admin'));
    }
}
