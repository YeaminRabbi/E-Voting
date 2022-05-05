<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserRegistrationController extends Controller
{
    function user_registration()
    {
        $organizers = User::whereRoleIs('organizer')->orderBy('id','desc')->get();
        return view('frontend.user_registration.register', compact('organizers'));
    }

    function UserAccountCreate(Request $req)
    {
        $req->validate([          
            'name' => 'required',  
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'organizer_id' => 'required'
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password =  Hash::make($req->password);
        $user->phone = $req->phone;
        $user->email_verified_at = Carbon::now();
        $user->organizer_id = $req->organizer_id;
        $user->save();

        $RegisteredUser = User::find($user->id);
        $RegisteredUser->attachRole('user');
        $RegisteredUser->save();

        return redirect()->route('login')->with('success', 'You Account has been Created!');

    }
}
