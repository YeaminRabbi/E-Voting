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

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:organizer');

    }


    function ResultHistory($id)
    {
        $portal = VotingPortal::where('id',$id)->where('organizer_id', Auth::id())->where('status', 2)->first();

        if(!empty($portal)){    
            $candidates = Candidate::where('organizer_id', $portal->organizer_id)->where('voting_portal_id',$portal->id)->get();
            $winnerData = Vote::where('voting_potal_id',$portal->id)
            ->selectRaw("COUNT(*) as total_vote")
            ->selectRaw("candidate_id")
            ->groupBy('candidate_id')
            ->get();
            
            
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
            return view('backend.organizer.voting-portal.result', compact('winnerCandidate', 'voteCount', 'portal', 'candidates'));
            
        }
        else{
            return view('404');
        }

    }

    function index()
    {
        return view('backend.organizer.home.home');

    }

    function addUsers()
    {

        $organizer = Auth::user();
        return view('backend.organizer.user-list.add-users',[
            'organizer' => $organizer
        ]);
    }


    function addSingleUser(Request $request)
    {
        $Alldata =$request->all();
        $rules = [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' =>'required|email|unique:users',

        ];
        $customMessage = [
            'name.required' => 'Name is required',
            'name.regex' => 'Valid name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Valid email is required',
            'password.required' => 'Password is required',
        ];

        $validator = Validator::make($Alldata,$rules,$customMessage);
        if($validator->fails()){
            return response()->json($validator->errors(),422);

        }

        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password =  Hash::make($request['phone']);
        $user->phone = $request['phone'];;
        $user->email_verified_at = Carbon::now();
        $user->organizer_id = $request->organizer_id;
        $user->save();

        $RegisteredUser = User::find($user->id);
        $RegisteredUser->attachRole('user');
        $RegisteredUser->save();

        return back()->with('success', 'User Added Successfully!');


    }


    function userlistUpload(Request $request)
    {

        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx',
            'organizer_id' => 'required'
        ]);
        $the_file = $request->file('uploaded_file');

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'F', $column_limit );
            $startcount = 2;
            $user_list = array();
            foreach ( $row_range as $row ) {
                $user_list[] = [
                    'name' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'email' => $sheet->getCell( 'B' . $row )->getValue(),
                    'phone' => $sheet->getCell( 'C' . $row )->getValue(),
                ];
                $startcount++;
            }

            $checkDuplicateEmail = 1;
            $duplicateEmail = null;
            foreach($user_list as $person)
            {
                $varifyEmail = User::where('email', $person['email'])->first();
                if(isset($varifyEmail))
                {
                    $duplicate = new DuplicateEmailUser;
                    $duplicate->name = $person['name'];
                    $duplicate->email = $person['email'];
                    $duplicate->phone = $person['phone'];
                    $duplicate->organizer_id = $request->organizer_id;
                    $duplicate->save();

                    $duplicateEmail = $duplicateEmail.'|'.$person['email'];
                    $checkDuplicateEmail = 0;
                    continue;
                }
                else{
                    $user = new User;
                    $user->name = $person['name'];
                    $user->email = $person['email'];
                    $user->password =  Hash::make($person['phone']);
                    $user->phone = $person['phone'];
                    $user->email_verified_at = Carbon::now();
                    $user->organizer_id = $request->organizer_id;
                    $user->save();

                    $RegisteredUser = User::find($user->id);
                    $RegisteredUser->attachRole('user');
                    $RegisteredUser->save();
                }


            }


        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }

        if($checkDuplicateEmail == 1)
        {
            return back()->with('success', 'Great! Data has been successfully uploaded.');
        }
        else{
            return back()->with([
                'duplicateEmail' => $duplicateEmail
            ]);

        }

    }

    function userlist()
    {
        $organizer = Auth::user();
        $users = User::whereRoleIs('user')->where('organizer_id', $organizer->id)->orderBy('id','desc')->get();

        return view('backend.organizer.user-list.list', compact('users'));
    }

    function votingportal()
    {
        $organizers = Auth::user();
        $users = User::whereRoleIs('user')->orderBy('id','desc')->get();

        return view('backend.organizer.voting-portal.create', compact('organizers','users'));

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
            return back()->with('success', 'Voting Poll Created Succesfully!');
        }
        else{
            return 'Error';
        }


    }


    function portallist()
    {
        $portals = VotingPortal::where('organizer_id', Auth::user()->id)->orderBy('id','desc')->get();
        return view('backend.organizer.voting-portal.list', compact('portals'));
    }

    function portalView($id)
    {
        $portal = VotingPortal::where('id',$id)->where('organizer_id', Auth::user()->id)->first();
        $candidates = Candidate::where('voting_portal_id',$id)->get();

        if(!empty($portal)){

            return view('backend.organizer.voting-portal.view', compact('portal', 'candidates'));
        }
        else{
            return view('404');
        }
    }


    function portalChange($id)
    {
        $portal = VotingPortal::where('id',$id)->where('organizer_id', Auth::user()->id)->first();
        $candidates = Candidate::where('voting_portal_id',$id)->get();
        $organizers = Auth::user();
        if(!empty($portal)){

            return view('backend.organizer.voting-portal.change', compact('portal', 'candidates', 'organizers'));
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


        $portal = VotingPortal::where('id', $req->portal_id)->where('organizer_id', Auth::user()->id)->first();
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
        $candidate = Candidate::where('id',$id)->where('organizer_id', Auth::user()->id)->first();
        if(!empty($candidate)){
            return view('backend.organizer.candidate.change', compact('candidate'));
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


    function portalActive($id)
    {
        $portal = VotingPortal::where('id',$id)->where('organizer_id', Auth::user()->id)->first();

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
        $portal = VotingPortal::where('id',$id)->where('organizer_id', Auth::user()->id)->first();

        if(!empty($portal)){
            $portal->status = 2;
            $portal->save();
            return back();
        }
        else{
            return view('404');
        }
    }
}
