<?php

namespace App\Http\Controllers;

use App\Beat;
use App\Song;
use App\Video;
use Illuminate\Support\Facades\File;

class ShoppingController extends Controller
{
    public function index(){
        return view('shop.index');
    }
    public function beats(){
        $beats = Beat::withCount('comments')->where('market', 'sale')->get();
        return view('shop.beats', compact('beats'));
    }
    public function singleBeat($b){
        $beat = Beat::findBeat($b);

        $size = $this->getFileSize($beat->location);

        return view('shop.singleBeat', compact('beat', 'size'));
    }
    public function music(){
        $songs = Song::withCount('comments')->where('market', 'sale')->get();
       
        return view('shop.music', compact('songs'));
    }

    public function singleMusic($s){
        $song = Song::findSong($s)->load('comments', 'category'); 
        
        $size = $this->getFileSize($song->location);

        return view('shop.singleMusic', compact('song', 'size'));
    }
    public function videos(){
        $videos = Video::withCount('comments')->where('market', 'sale')->get();
        return view('shop.videos', compact('videos')
    );
    }

    public function singleVideo($v){
        $video = Video::findVideo($v)->load('comments', 'category');
        $size = $this->getFileSize($video->location);
        return view('shop.singleVideo', compact('video', 'size'));
    }


}
