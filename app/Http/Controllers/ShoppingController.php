<?php

namespace App\Http\Controllers;

use App\Beat;
use App\Song;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ShoppingController extends Controller
{
    public function index(){
        return view('shop.index');
    }
    public function beats(){
        $beats = Beat::withCount('comments', 'downloads')->where('market', 'sale')->get();
        return view('shop.beats', compact('beats'));
    }
    public function singleBeat($b){
        $beat = Beat::where('uuid',$b)->firstOrFail();

        if(file_exists($beat->location)){
            $s = File::size($beat->location);
            $size = round($s / 1000000, 2);
        }
        return view('shop.singleBeat', compact('beat', 'size'));
    }
    public function music(){
        $songs = Song::withCount('comments', 'downloads')->where('market', 'sale')->get();
       
        return view('shop.music', compact('songs'));
    }

    public function singleMusic($s){
        $song = Song::where('uuid',$s)->firstOrFail()->load('downloads', 'comments', 'category'); 
        
        if(file_exists($song->location)){
            $s = File::size($song->location);
            $size = round($s / 1000000, 2);
        }
        return view('shop.singleMusic', compact('song', 'size'));
    }
    public function videos(){
        $videos = Video::withCount('comments', 'downloads')->where('market', 'sale')->get();
        return view('shop.videos', compact('videos')
    );
    }

    public function singleVideo($v){
        $video = Video::where('uuid',$v)->firstOrFail()->load('downloads', 'comments', 'category');
     
        if(file_exists($video->location)){
            $s = File::size($video->location);
            $size = round($s / 1000000, 2);
        }
        return view('shop.singleVideo', compact('video', 'size'));
    }


}
