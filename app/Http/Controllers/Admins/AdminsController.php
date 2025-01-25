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
public function createGenre(){

    return view('admins.creategenre');

}
public function storeGenre(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $storeGenre = Category::create([
        'name' => $validatedData['name'],
    ]);

    if ($storeGenre) {
        return Redirect::route('genre.all')->with(['success' => 'Genre Created Successfully']);
    }
}

public function deleteGenre($id){
    $genre = Category::find($id);
   
    $genre->delete();

    if ($genre) {
        return Redirect::route('genre.all')->with(['delete' => 'Show Deleted Successfully']);
    }
}



public function allEpisodes(){
    $episode = Episode::select()->orderBy('id','asc')->get();
    return view('admins.allepisodes',compact('episode'));
}

public function createEpisodes(){

    $show = Show::all();

    return view('admins.createepisodes',compact('show'));

}
public function storeEpisodes(Request $request)
{
    // Validasi data yang dikirimkan
    $validatedData = $request->validate([
        'episode_name' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'video' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
        'show' => 'required|exists:shows,id', 
    ]);
    

    // Penanganan file upload
    $myThumbnail = null;
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = 'assets/img/thumbnails'; // Direktori tujuan
        $thumbnailName = time() . '_' . $request->file('thumbnail')->getClientOriginalName(); // Nama file unik
        $request->file('thumbnail')->move(public_path($thumbnailPath), $thumbnailName); // Pindahkan file
        $myThumbnail = $thumbnailPath . '/' . $thumbnailName; // Simpan path lengkap
    }
    
    $myVideo = null;
    if ($request->hasFile('video')) {
        $videoPath = 'assets/videos'; // Direktori tujuan
        $videoName = time() . '_' . $request->file('video')->getClientOriginalName(); // Nama file unik
        $request->file('video')->move(public_path($videoPath), $videoName); // Pindahkan file
        $myVideo = $videoPath . '/' . $videoName; // Simpan path lengkap
    }
    
    // Simpan data ke dalam database
    $storeEpisode = Episode::create([
        'episode_name' => $validatedData['episode_name'],
        'thumbnail' => $myThumbnail,
        'video' => $myVideo,
        'show_id' => $validatedData['show'], 
    ]);
    

    // Redirect dengan pesan sukses jika data berhasil disimpan
    if ($storeEpisode) {
        return redirect()->route('episodes.all')->with('success', 'Episode Created Successfully');
    }

    // Jika gagal, redirect dengan pesan error
    return redirect()->back()->withErrors(['error' => 'Failed to create Episode'])->withInput();
}


public function deleteEpisodes($id)
{
    // Temukan episode berdasarkan ID
    $episode = Episode::find($id);

    // Jika episode tidak ditemukan, redirect dengan pesan error
    if (!$episode) {
        return Redirect::route('episodes.all')->withErrors(['error' => 'Episode not found']);
    }

    // Hapus file thumbnail jika ada
    if ($episode->thumbnail && File::exists(public_path($episode->thumbnail))) {
        File::delete(public_path($episode->thumbnail));
    }

    // Hapus file video jika ada
    if ($episode->video && File::exists(public_path($episode->video))) {
        File::delete(public_path($episode->video));
    }

    // Hapus data episode dari database
    $episode->delete();

    // Redirect dengan pesan sukses jika berhasil dihapus
    return Redirect::route('episodes.all')->with(['delete' => 'Episode Deleted Successfully']);
}
    
}
