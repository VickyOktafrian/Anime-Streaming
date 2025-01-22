<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function viewLogin(){
        
        
        return view('admins.login');
    }
    public function checkLogin(Request $request){
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index(){
        return view('admins.index');
    }
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    public function logout(Request $request)
{
    auth()->guard('admin')->logout(); // Logout dari guard admin
    $request->session()->invalidate(); // Invalidasi session
    $request->session()->regenerateToken(); // Regenerasi CSRF token
    return redirect()->route('view.login'); // Redirect ke halaman login admin
}
}
