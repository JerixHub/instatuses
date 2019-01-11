<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Summary;

class AdminController extends Controller
{
	
    public function dashboard()
    {
    	$summaries = Summary::all();
    	return view('admin.dashboard', compact('summaries'));
    }
}
