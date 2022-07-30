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

use App\Http\Resources\UserResournce;
use App\Http\Resources\PollResource;
use App\Http\Resources\ResultResource;
use App\Http\Resources\CandidateResource;

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


class ApiController extends Controller
{
    function getUser()
    {
        return UserResournce::collection(User::all());
    }

   function getPolls()
   {
        return PollResource::collection(VotingPortal::all());
   }

   function getResults()
   {
    return response([
        "data" =>  ResultResource::collection( VotingPortal::where('status', 2)->get())
    ]);
   }
}
