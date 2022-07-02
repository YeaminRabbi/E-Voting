<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


use Illuminate\Support\Facades\Hash;

class OpenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function myAccount()
    {
        $user = Auth::user();

        return view('backend.profile.index',compact('user'));
    }

    function UpdateProfile(Request $req)
    {

        $req->validate([
            'name' => 'required',
            'phone'=>'required'
        ]);


        $user = Auth::user();
        $user->name = $req->name;
        $user->phone = $req->phone;

        if(isset($req->password))
        {
            $user->password =  Hash::make($req->password);
        }

        $user->save();
        return back()->with('success', 'Profile Updated Successfully!');
    }
}
