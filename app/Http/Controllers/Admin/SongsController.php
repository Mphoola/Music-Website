<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\SongFormRequest;
use App\Song;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class SongsController extends Controller
{
    public function index(){
        return view('management.audios.index')->with('songs', Song::all());
    }
    public function create(){
        
        if(Category::count() == 0){
        
            return redirect()->route('categories.index')
                ->with('error', 'You need to add atleast once song genre!');
        } 
        return view('management.audios.create')->with('categories', Category::all());
    }
    public function upload(SongFormRequest $request){    
        
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
            'u_name' => Auth::guard('admin')->user()->name,
            'uuid' => (string)\Uuid::generate(4),
        
        ]);

        if($song) {
            return redirect()->route('songs.index')->with('success', 'Song added nicely');
        }
    }

    public function show($id){
        $song = Song::findOrFail($id);
        return view('management.audios.show', compact('song'));
    }
    public function edit($id){
        $song = Song::findOrFail($id);
        $categories = Category::all();
        return view('management.audios.create', compact('song','categories'));
    }
    public function update(SongFormRequest $request, $id){
        
        $song = Song::findOrFail($id);

        if($request->hasFile('song')){
            $songNameWithExt = request()->file('song')->getClientOriginalName();
            $songName = pathinfo($songNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('song')->getClientOriginalExtension();
            $songNameToStore = $songName.time().".".$extension;
            request()->file('song')->move(base_path().'/public/Uploads/Audios', $songNameToStore);

            if(file_exists($song->location)){
                unlink($song->location);
            }

            $song->location = 'Uploads/Audios/'. $songNameToStore;
        }
        
        $this->saveCoverImage($song);
        
        if($request->market == 'free'){
            $amt = 0;
        }else{
            $amt = $request->amount;
        }
      
        $song->title = $request->title;
        $song->artist = $request->artist;
        $song->producer = $request->producer;
        $song->category_id = $request->category_id;
        $song->released_date = $request->released_date;
        $song->market = $request->market;
        $song->amount = $amt;
        $song->saveOrFail();

        if($song) {
            return redirect()->route('songs.show', $song->id)->with('success', 'Song updated success');
        }
    }

}
