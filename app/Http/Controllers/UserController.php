<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\User;
use Carbon\Carbon;
use App\Candidate;
use App\VotingPortal;
use App\DuplicateEmailUser;
use App\Vote;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user');
    }

    function index()
    {
        $organizer = User::select('id','name','email','phone')->where('id', Auth::user()->organizer_id)->first();        
        $polls = VotingPortal::where('organizer_id', $organizer->id)->where('status', 1)->get();
        $previous_polls = VotingPortal::where('organizer_id', $organizer->id)->where('status', 2)->get();
        return view('backend.user.home.index',compact('organizer','polls','previous_polls'));
    }


    function GetToVote($id)
    {
        $portal = VotingPortal::where('id',$id)->first();

        if(!empty($portal)){

            //Checking if the user allready vote or not
            $checkVoter = Vote::where('user_id', Auth::id())->where('voting_potal_id', $id)->first();



            $candidates = Candidate::where('organizer_id', Auth::user()->organizer_id)->where('voting_portal_id',$portal->id)->get();
            $polls = VotingPortal::where('organizer_id', Auth::user()->organizer_id)->where('status', 1)->get();
            $previous_polls = VotingPortal::where('organizer_id',Auth::user()->organizer_id)->where('status', 2)->get();
    
            $testTrial =  VotingPortal::where('id',$portal->id)->first();
            $currentDate = Carbon::now();
            $startDate = $testTrial->date.' '.date('H:i:s', strtotime($testTrial->start_time));
            $endDate =  $testTrial->date.' '.date('H:i:s', strtotime($testTrial->end_time));
    
            if (($currentDate >= $startDate) && ($currentDate <= $endDate)){
                return view('backend.user.vote.vote', compact('portal', 'candidates','polls','checkVoter','previous_polls'));
              }else{
                return view('PollClosed');
              }
    
            return $candidates;
        }
        else{
            return view('404');
        }


       
    }


    function CastVote(Request $req)
    {
        $validated = $req->validate([
            'getcandidateID' => 'required'
        ]);
        
        
        $candidate = Candidate::where('id', $req->getcandidateID)->first();
        $portal = VotingPortal::where('id', $candidate->voting_portal_id)->first();
        // return $req->all();

        $vote = new Vote;
        $vote->user_id = Auth::id();
        $vote->organizer_id = $candidate->organizer_id;
        $vote->voting_potal_id = $candidate->voting_portal_id;
        $vote->candidate_id = $candidate->id;
        $vote->save();

        $user = Auth::user();
        
        $details = [
            'portal_position' =>  $portal->position
        ];
    
        \Mail::to( $user->email)->send(new \App\Mail\VoteConfirmationMail($details));
    

        return back();
    }

    function VotingHistory($id)
    {
        $portal = VotingPortal::where('id',$id)->where('status', 2)->first();

        if(!empty($portal)){

            $polls = VotingPortal::where('organizer_id', Auth::user()->organizer_id)->where('status', 1)->get();
            $previous_polls = VotingPortal::where('organizer_id', Auth::user()->organizer_id)->where('status', 2)->get();
    
            $candidates = Candidate::where('organizer_id', Auth::user()->organizer_id)->where('voting_portal_id',$portal->id)->get();

            $winnerData = Vote::where('voting_potal_id',$portal->id)
            ->selectRaw("COUNT(*) as total_vote")
            ->selectRaw("candidate_id")
            ->groupBy('candidate_id')
            ->get();
            // return $winnerData;
            
            $winnerID = "";
            $voteCount = -99999;
            foreach($winnerData as $key => $item)
            {
                if($item->total_vote > $voteCount){
                    $voteCount = $item->total_vote;
                    $winnerID = $item->candidate_id;
                }
            }
            
            $winnerCandidate = Candidate::where('id', $winnerID)->first();


            return view('backend.user.vote.result', compact('winnerCandidate', 'voteCount', 'portal', 'candidates', 'polls', 'previous_polls'));

            
    
            
        }
        else{
            return view('404');
        }

    }
}
