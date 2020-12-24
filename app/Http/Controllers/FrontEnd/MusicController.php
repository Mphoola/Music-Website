<?php

namespace App\Http\Controllers\FrontEnd;

use App\Beat;
use App\Category;
use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function index(){
        $music = Song::withCount('downloads', 'comments')->orderBy('created_at', 'desc')->paginate(8);
        $most_downloads = Song::withCount('downloads')->orderBy('downloads_count', 'desc')->take(5)->get();
        
        return view('frontEnd.music')
            ->with('categories', Category::all())
            ->with('musics', $music)
            ->with('most_downloads', $most_downloads);
    }

    public function show($uuid){
        $song = Song::where('uuid', $uuid)->firstOrFail();
        $song->with('downloads', 'comments');
        $most_downloads = Song::withCount('downloads')->orderBy('downloads_count', 'desc')->take(5)->get();
        return view('frontEnd.singleMusic')
            ->with('categories', Category::all())
            ->with('song', $song)
            ->with('most_downloads', $most_downloads);
    }

    public function download($uuid){
        $s = Song::where('uuid', $uuid)->firstOrFail();

        if($s){
            $loc = public_path().'/'. $s->location;
            
            // Storage::download($b->location, $name);
            return response()->download($loc);
            $s->downloads()->create();
        }
           
    }

    public function comment(Request $request,$uuid){
  
        $s = Song::where('uuid', $uuid)->firstOrFail();
        if($s){
         $s->comments()->create([
             'creator_name' => $request->creator_name,
             'creator_email' => $request->creator_email,
             'content' => $request->content,
         ]);
         return redirect()->back()->with('success', 'You have successfully commented');
        } 
    }

    public function showByCategory(Category $category){
        $most_downloads = Song::withCount('downloads')->orderBy('downloads_count', 'desc')->take(5)->get();
        $songs = $category->songs;
        return view('frontEnd.music')
            ->with('categories', Category::all())
            ->with('songs', $songs)
            ->with('most_downloads', $most_downloads)
            ->with('category', $category->name);
    }
}
