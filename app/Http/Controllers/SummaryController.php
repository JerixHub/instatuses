<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Program;
use App\Summary;
use App\Barangay;
use Auth;

class SummaryController extends Controller
{
    public function showProgram($program, $barangay, $user)
    {
    	// if user not found show 404 page
    	if(!$user){
    		abort(403);
    	}elseif($user != Auth::user()->id){
            abort(403);
        }elseif(!$barangay){
            abort(403);
        }

    	// check if user is admin
    	$is_admin = false;
    	$current_user = User::find($user);
        $current_program=Program::find($program);
        $current_barangay=Barangay::find($barangay);
    	if($current_user->is_admin){
    		$is_admin = true;
    	}else{
    		$is_admin = false;
            if($barangay != Auth::user()->barangay->id){
                abort(403);
            }
    	}

        $summaries=Summary::all();

        $dates=array('jan','feb','mar','1st Q', 'apr', 'may', 'jun', '2nd Q' ,'jul', 'aug', 'sept', '3rd Q', 'oct', 'nov', 'dec', '4th Q');
        $header;

    	return view('admin.summary.show', compact('is_admin', 'summaries', 'current_program', 'current_barangay', 'dates'));
    }
}