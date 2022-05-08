<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Candidate extends Model
{
    function get_organizer($id)
    {
        $organizer = User::select('name', 'email', 'phone')->where('id',$id)->first();
        return $organizer;
    }
}
