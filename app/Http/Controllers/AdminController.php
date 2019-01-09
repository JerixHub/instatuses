<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;

class AdminController extends Controller
{
	
    public function dashboard()
    {
    	$programs = Program::all();
    	return view('admin.dashboard', compact('programs'));
    }
}
