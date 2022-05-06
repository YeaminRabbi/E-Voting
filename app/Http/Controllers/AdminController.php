<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function organizer()
    {

        $organizers = User::whereRoleIs('organizer')->orderBy('id','desc')->get();
        return view('backend.organizer.organizer', compact('organizers'));
    }

    function organizercreate(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);


        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->password = Hash::make($req->password);
        $user->email_verified_at = Carbon::now();
        $user->details = $req->details;
        $user->save();


        $RegisteredUser = User::find($user->id);
        $RegisteredUser->attachRole('organizer');
        $RegisteredUser->save();

        return back();
    }

    function organizerdelete($id)
    {
        $user = User::where('id',$id)->first();
        if(!empty($user)){
            $user->delete();
            return back();
        }
        else{
            return view('404');
        }
       
    }


    function userlist()
    {

        $users = User::whereRoleIs('user')->orderBy('id','desc')->get();
        $organizer = User::whereRoleIs('organizer')->orderBy('id','desc')->get();

        return view('backend.user-list.list', compact('users','organizer'));
    }


    function votingportal()
    {
        $organizers = User::whereRoleIs('organizer')->orderBy('id','desc')->get();
        $users = User::whereRoleIs('user')->orderBy('id','desc')->get();

        return view('backend.voting-portal.create', compact('organizers','users'));
        
    }


    function portalcreate(Request $req)
    {
        return $req->all();
    }


}
