<?php

namespace App\Http\Controllers;

use App\Models\Show\Show;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $shows = Show::select()->orderBy('id','desc')->take(4)->get();
        return view('home',compact('shows'));
    }
}
