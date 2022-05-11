<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Candidate;
use App\VotingPortal;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');        
    }

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
           
       


        if($req->hasFile('img')){

            $portal = new VotingPortal;
            $portal->organizer_id = $req->organizer_id;
            $portal->date = $req->date;
            $portal->position = $req->position;
            $portal->start_time = $req->start_time;
            $portal->end_time = $req->end_time;
            $portal->save();
    

            $images = $req->file('img');

            
            foreach ($req->candidate_name as $key => $value) {
                $candidate = new Candidate;
                $candidate->organizer_id = $req->organizer_id;
                $candidate->voting_portal_id = $portal->id;
                $candidate->name = $req->candidate_name[$key];
                $candidate->email = $req->candidate_email[$key];
                $candidate->phone = $req->candidate_phone[$key];
                $candidate->designation = $req->designation[$key];
    
                // Storage::putFile('public/images/candidate/',$images[$key]);
                // $candidate->image = "public/images/candidate/".$images[$key]->hashName();
                
                $IMGNAME = Str::random(10).'.'. $images[$key]->getClientOriginalExtension();       
                $thumbnail_location = 'images/candidate/'
                . Carbon::now()->format('Y/M/')
                .'/';
    
                //Make Directory 
                File::makeDirectory($thumbnail_location, $mode=0777, true, true);        
                //save Image to the thumbnail path
                Image::make($images[$key])->save(public_path($thumbnail_location.$IMGNAME));

                $candidate->image = $IMGNAME;


                $candidate->save();
            }  
            return back();
        }
        else{
            return 'Error';
        }
        

    }

    function portallist()
    {
        $portals = VotingPortal::orderBy('id','desc')->get();

        return view('backend.voting-portal.list', compact('portals'));
    }


    function portalActive($id)
    {
        $portal = VotingPortal::where('id',$id)->first();

        if(!empty($portal)){
            $portal->status = 1;
            $portal->save();
            return back();
        }
        else{
            return view('404');
        }

    }


    function portalClose($id)
    {
        $portal = VotingPortal::where('id',$id)->first();

        if(!empty($portal)){
            $portal->status = 2;
            $portal->save();
            return back();
        }
        else{
            return view('404');
        }
    }


    function portalView($id)
    {
        $portal = VotingPortal::where('id',$id)->first();
        $candidates = Candidate::where('voting_portal_id',$id)->get();

        if(!empty($portal)){
            
            return view('backend.voting-portal.view', compact('portal', 'candidates'));
        }
        else{
            return view('404');
        }
    }


    function portalChange($id)
    {
        $portal = VotingPortal::where('id',$id)->first();
        $candidates = Candidate::where('voting_portal_id',$id)->get();
        $organizers = User::whereRoleIs('organizer')->orderBy('id','desc')->get();
        
        if(!empty($portal)){
            
            return view('backend.voting-portal.change', compact('portal', 'candidates', 'organizers'));
        }
        else{
            return view('404');
        }
    }


    function portalupdate(Request $req)
    {
        $req->validate([
            'organizer_id' => 'required',
            'date'=>'required',
            'position'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'portal_id'=>'required'
        ]);
        
   
        $portal = VotingPortal::where('id', $req->portal_id)->first();
        if(!empty($portal)){
        
            $portal->organizer_id = $req->organizer_id;
            $portal->date = $req->date;
            $portal->position = $req->position;
            $portal->start_time = $req->start_time;
            $portal->end_time = $req->end_time;
            $portal->save();

            $candidates = Candidate::where('voting_portal_id',$req->portal_id)->get();

            foreach ($candidates as $key => $person) {
                $person->organizer_id = $portal->organizer_id;
                $person->save();
            }

            return back();
    
        }
        else{
            return view('404');
        }           
            

    }


    function CandidateChange($id)
    {
        $candidate = Candidate::where('id',$id)->first();
        if(!empty($candidate)){
            return view('backend.candidate.change', compact('candidate'));
        }
        else{
            return view('404');
        }
    }

    function CandidateUpdate(Request $req){
        $req->validate([
            'candidate_id' => 'required',
            'candidate_name'=>'required',
            'candidate_email'=>'required',
            'candidate_phone'=>'required',
            'designation'=>'required'
        ]);

        $candidate = Candidate::where('id',$req->candidate_id)->first();
        if(!empty($candidate)){
             
            if($req->hasFile('img')){
                $images = $req->file('img');
                $IMGNAME = Str::random(10).'.'. $images->getClientOriginalExtension();       
                $thumbnail_location = 'images/candidate/'
                . Carbon::now()->format('Y/M/')
                .'/';    
                //Make Directory 
                File::makeDirectory($thumbnail_location, $mode=0777, true, true);        
                //save Image to the thumbnail path
                Image::make($images)->save(public_path($thumbnail_location.$IMGNAME));

                $candidate->image = $IMGNAME;
            }
           
            $candidate->name = $req->candidate_name;
            $candidate->email = $req->candidate_email;
            $candidate->phone = $req->candidate_phone;
            $candidate->designation = $req->designation;
            $candidate->save();
            return back();
        }
        else{
            return view('404');
        }

    }

    function candidateAddNew(Request $req){
        $req->validate([
            'organizer_id' => 'required',
            'voting_portal_id' => 'required',
            'candidate_name'=>'required',
            'candidate_email'=>'required',
            'candidate_phone'=>'required',
            'img'=>'required'
        ]);

        if($req->hasFile('img')){
            $images = $req->file('img');
            $IMGNAME = Str::random(10).'.'. $images->getClientOriginalExtension();       
            $thumbnail_location = 'images/candidate/'
            . Carbon::now()->format('Y/M/')
            .'/';    
            //Make Directory 
            File::makeDirectory($thumbnail_location, $mode=0777, true, true);        
            //save Image to the thumbnail path
            Image::make($images)->save(public_path($thumbnail_location.$IMGNAME));

          
        }
        $candidate = new Candidate;
        $candidate->organizer_id = $req->organizer_id;
        $candidate->voting_portal_id = $req->voting_portal_id;
        $candidate->name = $req->candidate_name;
        $candidate->email = $req->candidate_email;
        $candidate->phone = $req->candidate_phone;
        $candidate->designation = $req->designation;
        $candidate->image = $IMGNAME;
        $candidate->save();
        return back();



    }
}
