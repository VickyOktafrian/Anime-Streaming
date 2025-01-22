<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\Following\Following;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function followedShows(){
        $followedShows = Following::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();   
        return view('users.followed-shows', compact('followedShows'));
    }
}    
