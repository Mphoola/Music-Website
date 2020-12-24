<?php

namespace App\Http\Controllers\FrontEnd;

use App\Beat;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeatFormRequest;
use App\Http\Requests\SongFormRequest;
use App\Http\Requests\VideoFormRequest;
use App\Song;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index(){
        $music = Song::withCount('downloads', 'comments')->take(8)->get();
        $beats = Beat::withCount('downloads', 'comments')->take(4)->get();
        $vidios = Video::withCount('downloads', 'comments')->take(4)->get();
        $most_downloads = Song::withCount('downloads')->orderBy('downloads_count', 'desc')->take(5)->get();
        
        return view('frontEnd.welcome')
            ->with('categories', Category::all())
            ->with('musics', $music)
            ->with('beats', $beats)
            ->with('videos', $vidios)
            ->with('most_downloads', $most_downloads);
    }
    
    public function home(){
        return view('frontEnd.auth.home'); 
    }

    public function myAudios(){
        $songs = auth()->user()->songs->load('downloads', 'category');
        
        return view('frontEnd.auth.myAudios')->with('songs', $songs);
    }

    public function myAudioCreate(){
        return view('frontEnd.auth.createAudio')->with('categories', Category::all());
    }

    public function myAudioUpload(SongFormRequest $request){
        
        if($request->hasFile('song')){
            $songNameWithExt = request()->file('song')->getClientOriginalName();
            $songName = pathinfo($songNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('song')->getClientOriginalExtension();
            $songNameToStore = $songName.time().".".$extension;
            request()->file('song')->move(base_path().'/public/Uploads/Audios', $songNameToStore);
        }
        if (request()->hasFile('cover_image')) {
            $picNameWithExt = request()->file('cover_image')->getClientOriginalName();
            $picName = pathinfo($picNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('cover_image')->getClientOriginalExtension();
            $picNameToStore = $picName.time().".".$extension;
            request()->file('cover_image')->move(base_path().'/public/Uploads/Cover_images', $picNameToStore);
            
           // this is to resize the image using Intervention Image!
           $image_path = base_path().'/public/Uploads/Cover_images/'. $picNameToStore;
           Image::make($image_path)->resize(1160, 950)->save();
        }
        if($request->market == 'free'){
            $amt = 0;
        }else{
            $amt = $request->amount;
        }
       $song=  Song::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'producer' => $request->producer,
            'category_id' => $request->category_id,
            'released_date' => $request->released_date,
            'market' => $request->market,
            'amount' => $amt,
            'cover_image' => 'Uploads/Cover_images/'. $picNameToStore,
            'location' => 'Uploads/Audios/'. $songNameToStore,
            'user_id' => Auth::id(),
            'uuid' => (string)\Uuid::generate(4),
        ]);

        if($song) {
            return redirect()->route('myAudios')->with('success', 'Song added nicely');
        }
    }

    public function myVideos(){
        $videos = auth()->user()->videos;
        return view('frontEnd.auth.myVideos', compact('videos'));
    }

    public function myVideoCreate(){
        return view('frontEnd.auth.createVideo')->with('categories', Category::all());
    }

    public function myVideoUpload(VideoFormRequest $request){
    
        
        if($request->hasFile('video')){
            $videoNameWithExt = request()->file('video')->getClientOriginalName();
            $videoName = pathinfo($videoNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('video')->getClientOriginalExtension();
            $videoNameToStore = $videoName.time().".".$extension;
            request()->file('video')->move(base_path().'/public/Uploads/Videos', $videoNameToStore);
        }
        if (request()->hasFile('cover_image')) {
            $picNameWithExt = request()->file('cover_image')->getClientOriginalName();
            $picName = pathinfo($picNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('cover_image')->getClientOriginalExtension();
            $picNameToStore = $picName.time().".".$extension;
            request()->file('cover_image')->move(base_path().'/public/Uploads/Cover_images', $picNameToStore);
            
            // this is to resize the image using Intervention Image!
            $image_path = base_path().'/public/Uploads/Cover_images/'. $picNameToStore;
            Image::make($image_path)->resize(1160, 950)->save();
        }
        if($request->market == 'free'){
            $amt = 0;
        }else{
            $amt = $request->amount;
        }
       $video=  Video::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'producer' => $request->producer,
            'category_id' => $request->category_id,
            'released_date' => $request->released_date,
            'market' => $request->market,
            'amount' => $amt,
            'cover_image' => 'Uploads/Cover_images/'. $picNameToStore,
            'location' => 'Uploads/videos/'. $videoNameToStore,
            'user_id' => Auth::id(),
            'uuid' => (string)\Uuid::generate(4),
        ]);

        if($video) {
            return redirect()->route('videos.index')->with('success', 'video added nicely');
        }
    }

    public function myBeats(){
        $beats = auth()->user()->beats;
        return view('frontEnd.auth.myBeats', compact('beats'));
    }

    public function myBeatCreate(){
        return view('frontEnd.auth.createBeat')->with('categories', Category::all());
    }

    public function myBeatUpload(BeatFormRequest $request){
    
        
        if($request->hasFile('beat')){
            $beatNameWithExt = request()->file('beat')->getClientOriginalName();
            $beatName = pathinfo($beatNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('beat')->getClientOriginalExtension();
            $beatNameToStore = $beatName.time().".".$extension;
            request()->file('beat')->move(base_path().'/public/Uploads/Beats', $beatNameToStore);
        }
        if (request()->hasFile('cover_image')) {
            $picNameWithExt = request()->file('cover_image')->getClientOriginalName();
            $picName = pathinfo($picNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('cover_image')->getClientOriginalExtension();
            $picNameToStore = $picName.time().".".$extension;
            request()->file('cover_image')->move(base_path().'/public/Uploads/Cover_images', $picNameToStore);
            
            // this is to resize the image using Intervention Image!
            $image_path = base_path().'/public/Uploads/Cover_images/'. $picNameToStore;
            Image::make($image_path)->resize(1160, 950)->save();
        }
        if($request->market == 'free'){
            $amt = 0;
        }else{
            $amt = $request->amount;
        }
       $beat=  Beat::create([
            'title' => $request->title,
            'producer' => $request->producer,
            'category_id' => $request->category_id,
            'released_date' => $request->released_date,
            'market' => $request->market,
            'amount' => $amt,
            'cover_image' => 'Uploads/Cover_images/'. $picNameToStore,
            'location' => 'Uploads/Beats/'. $beatNameToStore,
            'user_id' => Auth::id(),
            'uuid' => (string)\Uuid::generate(4),
            
        ]);

        if($beat) {
            return redirect()->route('myBeats')->with('success', 'beat added nicely');
        }
    }
}
