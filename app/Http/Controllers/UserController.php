<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Barangay;
use Storage;
use File;

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
        $barangays = Barangay::all();
        
        return view('admin.users.index', compact('users', 'verified', 'daily_registrants', 'barangays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barangays = Barangay::all();
        return view('admin.users.create', compact('barangays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname'  => 'required',
            'email'     => 'required',
        ]);

        $user = new User;

        if(!empty($request->image_url)){
            $file=$request->file('image_url');
            $extension=$file->getClientOriginalExtension();
            Storage::disk('public')->put($file->getFilename().'.'.$extension, File::get($file));

            $user->image_url = $file->getFilename().'.'.$extension;
        }

        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->barangay_id = $request->barangay_id;
        if(array_key_exists('is_verified', $request->all())){
            $user->is_verified = 1;
        }else{
            $user->is_verified = 0;
        }

        if(array_key_exists('is_admin', $request->all())){
            $user->is_admin = 1;
        }else{
            $user->is_admin = 0;
        }

        $user->password = bcrypt($request->password);

        $user->save();

        return redirect('/admin/users')->with('message', 'Successfully Added '.$user->name);
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

        // validate

        $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required',
        ]);

        $current_user = User::find($id);
        if(!empty($request->image_url)){
            $file=$request->file('image_url');
            $extension=$file->getClientOriginalExtension();
            Storage::disk('public')->put($file->getFilename().'.'.$extension, File::get($file));


            $current_user->image_url = $file->getFilename().'.'.$extension;
        }else{
            $current_user->image_url = $request->image_url_val;
        }

        $current_user->name = $request->fullname;
        $current_user->email = $request->email;
        $current_user->barangay_id = $request->barangay;

        if(array_key_exists('is_verified', $request->all())){
            $current_user->is_verified = 1;
        }else{
            $current_user->is_verified = 0;
        }

        if(array_key_exists('is_admin', $request->all())){
            $current_user->is_admin = 1;
        }else{
            $current_user->is_admin = 0;
        }

        $current_user->save();

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function getAllUsers()
    {
        $users = User::paginate(20);
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
