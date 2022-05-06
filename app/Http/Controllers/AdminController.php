<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Candidate;
use App\VotingPortal;

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

        $req->validate([
            'organizer_id' => 'required',
            'date'=>'required',
            'position'=>'required',
            'start_time'=>'required',
            'end_time'=>'required'
        ]);
           
        $portal = new VotingPortal;
        $portal->organizer_id = $req->organizer_id;
        $portal->date = $req->date;
        $portal->position = $req->position;
        $portal->start_time = $req->start_time;
        $portal->end_time = $req->end_time;
        $portal->save();

        foreach ($req->candidate_name as $key => $value) {
            $candidate = new Candidate;
            $candidate->organizer_id = $req->organizer_id;
            $candidate->voting_portal_id = $portal->id;
            $candidate->name = $req->candidate_name[$key];
            $candidate->email = $req->candidate_email[$key];
            $candidate->image = '$req->candidate_email[$key];';
            $candidate->phone = $req->candidate_phone[$key];
            $candidate->designation = $req->designation[$key];

            $candidate->save();
        }  

        return back();
    }


}
