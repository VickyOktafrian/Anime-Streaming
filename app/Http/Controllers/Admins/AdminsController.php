<?php

namespace App\Http\Controllers\Admins;

use App\Models\Show\Show;
use Illuminate\Http\Request;
use App\Models\Admins\Admins;
use App\Models\Episode\Episode;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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

        $shows = Show::select()->count();
        $episodes = Episode::select()->count();
        $admins = Admins::select()->count();
        $categories = Category::select()->count();
        return view('admins.index',compact('shows','episodes','admins','categories'));
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

    public function allAdmins(){
        $admins = Admins::select()->orderBy('id','asc')->get();
        return view('admins.alladmins',compact('admins'));
    }

    public function createAdmins(){

        return view('admins.createadmins');

    }
    public function storeAdmins(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:admins,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        $storeAdmins = Admins::create([
            'email' => $validatedData['email'],
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
        ]);
    
        if ($storeAdmins) {
            return Redirect::route('admins.all')->with(['success' => 'Admin Created Successfully']);
        }
    }


    public function allShows(){
        $shows = Show::select()->orderBy('id','asc')->get();
        return view('admins.allshows',compact('shows'));
    }

    public function createShows(){

        $categories = Category::all();

        return view('admins.createshows',compact('categories'));

    }
    public function storeShows(Request $request)
{

    // Validasi data yang dikirimkan
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // opsional untuk gambar
        'description' => 'nullable|string',
        'type' => 'required|string|max:100',
        'studios' => 'nullable|string|max:255',
        'date_aired' => 'nullable|date',
        'status' => 'required|string|max:50',
        'genre' => 'nullable|string|max:255',
        'duration' => 'nullable|string|max:50',
        'quality' => 'nullable|string|max:50',
    ]);

    // Penanganan file gambar jika ada
    $myImage = null;
    if ($request->hasFile('image')) {
        $destinationPath = 'assets/img/anime/';
        $myImage = time() . '_' . $request->image->getClientOriginalName(); // Menghindari duplikasi nama file
        $request->image->move(public_path($destinationPath), $myImage);
    }

    // Simpan data ke dalam database
    $storeShows = Show::create([
        'name' => $validatedData['name'],
        'image' => $myImage,
        'description' => $validatedData['description'] ?? null,
        'type' => $validatedData['type'],
        'studios' => $validatedData['studios'] ?? null,
        'date_aired' => $validatedData['date_aired'] ?? null,
        'status' => $validatedData['status'],
        'genre' => $validatedData['genre'] ?? null,
        'duration' => $validatedData['duration'] ?? null,
        'quality' => $validatedData['quality'] ?? null,
    ]);

    // Redirect dengan pesan sukses jika data berhasil disimpan
    if ($storeShows) {
        return Redirect::route('shows.all')->with(['success' => 'Show Created Successfully']);
    }

    // Jika gagal, redirect dengan pesan error
    return Redirect::back()->withErrors(['error' => 'Failed to create Show'])->withInput();
}
public function deleteShows($id){
    $show = Show::find($id);
    if(File::exists(public_path('assets/img/anime/' . $show->image))){
        File::delete(public_path('assets/img/anime/' . $show->image));
    }else{
        //dd('File does not exists.');
    }
    $show->delete();

    if ($show) {
        return Redirect::route('shows.all')->with(['delete' => 'Show Deleted Successfully']);
    }
}


public function allGenre(){
    $genre = Category::select()->orderBy('id','asc')->get();

    return view('admins.allgenre',compact('genre'));

    

}



    

    
}
