<?php

namespace App\Http\Controllers\Anime;

use App\Models\Category\Category;
use App\Models\Episode\Episode;
use App\Models\Following\Following;
use App\Models\Show\Show;
use Illuminate\Http\Request;
use App\Models\Comment\Comment;
use App\Http\Controllers\Controller;
use App\Models\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AnimeController extends Controller
{
    public function animeDetails($id){
        $show = Show::find($id);
        $randomShows = Show::select()->orderBy('id','desc')->take(5)->where('id','!=',$id)->get();
        $comments = Comment::select()->orderBy('id','desc')->take(8)->where('show_id',$id)->get();
        $views = View::where('show_id', $id)->count();
        $totalComments = Comment::where('show_id', $id)->count();
        $firstEpisode = Episode::where('show_id', $id)->orderBy('id', 'asc')->first(); // Ambil episode pertama
    
        // Validasi jika user login
        $validateFollowing = Auth::check() 
            ? Following::where('user_id', Auth::id())->where('show_id', $id)->count() 
            : 0;
    
        return view('shows.anime-details', compact('show', 'randomShows', 'comments', 'validateFollowing', 'views', 'totalComments', 'firstEpisode'));
    }
    public function insertComments(Request $request, $id){
        if (!Auth::check()) {
            return Redirect::route('anime.details', $id)->with('error', 'You need to log in to comment.');
        }
    
        $insertComments = Comment::create([
            "show_id" => $id,
            "user_name" => Auth::user()->name,
            "image" => Auth::user()->image,
            "comment" => $request->comment
        ]);
        if ($insertComments) {
            return Redirect::route('anime.details', $id)->with('success', 'Comment added successfully.');
        }
    }
    
    public function follow(Request $request, $id)
    {
        // Periksa apakah user sudah mengikuti show ini
        $alreadyFollowing = Following::where('show_id', $id)
            ->where('user_id', Auth::id())
            ->exists();
    
        if ($alreadyFollowing) {
            return Redirect::route('anime.details', $id)->with('error', 'You are already following this show.');
        }
    
        // Buat entri baru untuk mengikuti show
        $follow = Following::create([
            'show_id' => $id,
            'user_id' => Auth::id(),
            'show_image'=> $request->show_image,
            'show_name'=> $request->show_name
        ]);
    
        if ($follow) {
            return Redirect::route('anime.details', $id)->with('success', 'You followed this show successfully.');
        }
    
        // Jika gagal, beri pesan error
        return Redirect::route('anime.details', $id)->with('error', 'Failed to follow this show. Please try again.');
    }
    
   
public function view(Request $request, $id){
    if (!Auth::check()) {
        return Redirect::route('anime.details', $id)->with('error', 'You need to log in to record a view.');
    }

    $insertViews = View::create([
        "show_id" => $id,
        "user_id" => Auth::user()->id,
    ]);

    if ($insertViews) {
        return Redirect::route('anime.details', $id)->with('success', 'View successfully recorded.');
    }

    return Redirect::back()->with('error', 'Failed to record view.');
}

public function animeWatch($show_id, $episode_name){
    $show = Show::find($show_id);
    $episode = Episode::where('episode_name', $episode_name)
        ->where('show_id', $show_id)
        ->firstOrFail();
    $episodes = Episode::select()->where('show_id', $show_id)->get();
    $comments = Comment::select()->orderBy('id', 'desc')->take(8)->where('show_id', $show_id)->get();

    return view('shows.anime-watch', compact('show', 'episode', 'episodes', 'comments'));
}

public function category($category_name)
{
    // Get the category by its name
    $category = Category::where('name', $category_name)->firstOrFail();

    // Get the shows related to this category (by genre)
    $shows = Show::where('genre', $category_name)->get();

    // Get the 'For You' shows (latest 4 shows)
    $foryouShow = Show::orderBy('id', 'desc')->take(4)->get();

    // Pass the category, shows, and 'For You' shows to the view
    return view('shows.category', compact('category', 'shows', 'foryouShow'));
}
public function searchShows(Request $request)
{
   $show = $request->get('show');
   $searches = Show::where('name','like',"%$show%")->get();
   $foryouShow = Show::orderBy('id', 'desc')->take(4)->get();


    // Pass the category, shows, and 'For You' shows to the view
    return view('shows.searches', compact('searches','foryouShow'));
}


}
