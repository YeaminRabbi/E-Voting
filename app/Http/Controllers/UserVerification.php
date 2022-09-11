<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class UserVerification extends Controller
{
    function index()
    {
        $user = Auth::user();
        return view('backend.user.varify.validation',compact('user'));
    }

    function sendOTP(Request $req){
        $req->validate([
            'user_id' => 'required',
            'email' => 'required'
        ]);
      
        $checkEmailExist = User::where('email', $req->email)->first();        //checking if user_id belongs to this email
        if(!isset($checkEmailExist))
        {
            return back()->with('error', 'This Email doesnot exist!') ;
        }

        if(User::find($req->user_id)->email != $req->email)
        {
            return back()->with('error', 'you are not authorized with this mail!');
        }
        else{

            $otp = strtoupper(Str::random(6));
            $checkEmailExist->otp_token = $otp;
            $checkEmailExist->save();

            $details = [
                    'otp' => $otp
                ];

            \Mail::to($req->email)->send(new \App\Mail\SendOTP($details));
   
            
            // return 'This user has this email--------'.$req->email.'-----------'.$otp;
            return view('backend.user.varify.confirmation',[
                'email' => $req->email
            ]);


        }

    }


    function confirmOTP(Request $req)
    {
        $req->validate([
            'otp' => 'required',
            'email' => 'required'
        ]);
        $getUser = User::where('email', $req->email)->first();

        if($getUser->otp_token != $req->otp)
        {
            return 'OTP not matched!';
            // return back()->with('error', 'OTP not matched!');
        }
        else{
            $getUser->is_verified=1;
            $getUser->save();
            return redirect()->route('user-panel');
        }
    }
}
