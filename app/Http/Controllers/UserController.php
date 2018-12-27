<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->getAllUsers();
        $verified = $this->getVerifiedUsers();
        $daily_registrants = $this->getDailyRegistrants();
        
        return view('admin.users', compact('users', 'verified', 'daily_registrants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllUsers()
    {
        $users = User::all();
        return $users;
    }

    public function getVerifiedUsers()
    {
        $users = $this->getAllUsers();
        $verified = array();
        foreach ($users as $user) {
            if($user->is_verified){
                array_push($verified, $user);
            }
        }

        return $verified;
    }

    public function getDailyRegistrants()
    {
        $users = $this->getAllUsers();
        $daily_registrants = array();
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d');
        foreach ($users as $user) {
            $created_date = date('Y-m-d', strtotime($user->created_at));
            if($created_date == $today){
                array_push($daily_registrants, $user);
            }
        }

        return $daily_registrants;
    }

    public function getAdminUsers()
    {
        $users = $this->getAllUsers();
        $admins = array();
        foreach ($users as $user) {
            if($user->is_admin){
                array_push($admins, $user);
            }
        }

        return $admins;
    }
}
