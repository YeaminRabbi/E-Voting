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


            if(Auth::user()->hasRole('admin')){

               return redirect()->route('dashboard');

            }else if(Auth::user()->hasRole('user')){

                //return redirect()->route('user-panel');
                return 'this is a user pane';

            }else if(Auth::user()->hasRole('organizer') ){

                return redirect()->route('oraganizer-panel');
            }

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
