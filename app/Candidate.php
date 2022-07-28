<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Vote;
class Candidate extends Model
{
    function get_organizer($id)
    {
        $organizer = User::select('name', 'email', 'phone')->where('id',$id)->first();
        return $organizer;
    }

    function get_voteCount($id)
    {
       
        $count = Vote::where('candidate_id', $id)->get();
        return $count->count();

    }
}
