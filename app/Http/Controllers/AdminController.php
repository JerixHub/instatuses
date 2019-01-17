<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Summary;
use Auth;
class AdminController extends Controller
{

    public function dashboard()
    {
        $programs = Program::where('barangay_id', Auth::user()->barangay_id)->get();
    	return view('admin.dashboard', compact('programs'));
    }
}
