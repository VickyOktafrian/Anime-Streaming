<?php

namespace App\Http\Controllers\Anime;

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
        $validateFollowing = Following::where('user_id',Auth::user()->id)->where('show_id',$id)->count();
        $views = View::where('show_id',$id)->count();
        $totalComments = Comment::where('show_id',$id)->count();
        $firstEpisode = Episode::where('show_id', $id)->orderBy('id', 'asc')->first(); // Ambil episode pertama


        return view('shows.anime-details', compact('show','randomShows','comments','validateFollowing','views','totalComments','firstEpisode'));
    }

    public function insertComments(Request  $request, $id){
        
        $insertComments = Comment::create([
            "show_id"=>   $id,
            "user_name"=>Auth::user()->name,
            "image"=>Auth::user()->image,
            "comment"=> $request->comment
        ]);
        if($insertComments){
            return Redirect::route('anime.details',$id)->with('success','Comment added Successfully');
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
        ]);
    
        if ($follow) {
            return Redirect::route('anime.details', $id)->with('success', 'You followed this show successfully.');
        }
    
        // Jika gagal, beri pesan error
        return Redirect::route('anime.details', $id)->with('error', 'Failed to follow this show. Please try again.');
    }
    
    public function view(Request $request, $id)
{
    $insertViews = View::create([
        "show_id" => $id,
        "user_id" => Auth::user()->id, // Correct key here
    ]);

    if ($insertViews) {
        return Redirect::route('anime.details', $id)->with('success', 'View Successfully');
    }

    return Redirect::back()->with('error', 'Failed to record view');
}

public function animeWatch($show_id,$episode_id){
    $show = Show::find($show_id);
    $episode = Episode::find($episode_id);
    $episodes = Episode::select()->where('show_id',$show_id)->get();
    return view('shows.anime-watch',compact('show','episode','episodes'));
}

}
