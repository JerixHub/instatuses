<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SummaryController extends Controller
{
    public function show($program, $barangay=null, $user=null)
    {
    	// if user not found show 404 page
    	if(!$user){
    		abort(404);
    	}

    	// check if user is admin
    	$is_admin = false;
    	$current_user = User::find($user);
    	if($current_user->is_admin){
    		$is_admin = true;
    	}else{
    		$is_admin = false;
    	}

    	// return $is_admin;
    }
}