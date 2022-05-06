<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    function LOGIN(Request $req)
    {   

        $req->validate([          
            'email' => 'required|email',          
            'password' => 'required'
        ]);

        if (Auth::attempt(array('email' => $req->email, 'password' => $req->password))){
            
            return redirect()->route('organizer');
         }else{
            return back()->with('error', "These credentials doesn't match with our records");
         }     
    }



    function LOGOUT()
    {
        Auth::logout();
        return redirect()->route('adminlogin');
    }
}
