<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;
use App\User;

class DuplicateEmailUser extends Model
{
    function getOrganizer($id)
    {
        $organizer = User::where('id',$id)->first();
        return $organizer;
    }

}
