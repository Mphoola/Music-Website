<?php

namespace App\Http\Controllers\FrontEnd;

use App\Beat;
use App\Category;
use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MusicController extends Controller
{
    public function index(){
        $music = Song::withCount('comments')
            ->where('market', 'free')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        $most_downloads = $this->most_downloads();
        
        return view('frontEnd.music')
            ->with('categories', Category::all())
            ->with('musics', $music)
            ->with('most_downloads', $most_downloads);
    }

    public function show($uuid){
        $song = Song::findSong($uuid);
        $size = $this->getFileSize($song->location);
        $song->with('comments', 'category');
        $most_downloads = $this->most_downloads();
        return view('frontEnd.singleMusic')
            ->with('categories', Category::all())
            ->with('song', $song)
            ->with('size', $size)
            ->with('most_downloads', $most_downloads);
    }

    public function download($uuid){
        $s = Song::findSong($uuid);

        return $this->downloadFile($s); 
    }

    public function comment(Request $request,$uuid){
  
        $s = Song::findSong($uuid);
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
        $most_downloads = $this->most_downloads();
        $songs = $category->songs()->withCount('comments')->paginate(12);
        return view('frontEnd.music')
            ->with('categories', Category::all())
            ->with('songs', $songs)
            ->with('most_downloads', $most_downloads)
            ->with('category', $category->name);
    }

    private function most_downloads(){
        return Song::where('market', 'free')->orderBy('downloads_count', 'desc')->take(5)->get();
    }
}
