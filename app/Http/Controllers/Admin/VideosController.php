<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFormRequest;
use App\Http\Requests\VideoFormRequest;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class videosController extends Controller
{
    public function index(){
        return view('management.videos.index')->with('videos', Video::all());
    }
    public function create(){
        if(Category::count() == 0){
            return redirect()->route('categories.index')
                ->with('error', 'You need to add atleast once video genre!');
        }
        return view('management.videos.create')->with('categories', Category::all());
    }
    public function upload(VideoFormRequest $request){
    
        
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
            'u_name' => Auth::guard('admin')->user()->name,
            'uuid' => (string)\Uuid::generate(4),
        ]);

        if($video) {
            return redirect()->route('videos.index')->with('success', 'video added nicely');
        }
    }

    public function show($id){
        $video = Video::findOrFail($id);
        return view('management.videos.show', compact('video'));
    }
    public function edit($id){
        $video = Video::findOrFail($id);
        $categories = Category::all();
        return view('management.videos.create', compact('video','categories'));
    }
    public function update(VideoFormRequest $request, $id){
       
        $video = Video::findOrFail($id);

        if($request->hasFile('video')){
            $videoNameWithExt = request()->file('video')->getClientOriginalName();
            $videoName = pathinfo($videoNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('video')->getClientOriginalExtension();
            $videoNameToStore = $videoName.time().".".$extension;
            request()->file('video')->move(base_path().'/public/Uploads/Videos', $videoNameToStore);

            if(file_exists($video->location)){
                unlink($video->location);
            }

            $video->location = 'Uploads/videos/'. $videoNameToStore;
        }
        
        $this->saveCoverImage($video);

        if($request->market == 'free'){
            $amt = 0;
        }else{
            $amt = $request->amount;
        }
      
        $video->title = $request->title;
        $video->artist = $request->artist;
        $video->producer = $request->producer;
        $video->category_id = $request->category_id;
        $video->released_date = $request->released_date;
        $video->market = $request->market;
        $video->amount = $amt;
        $video->saveOrFail();

        if($video) {
            return redirect()->route('videos.show', $video->id)->with('success', 'video updated success');
        }
    }

}
