<?php

namespace App\Http\Controllers\Admin;

use App\Beat;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeatFormRequest;
use App\Http\Requests\CreateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Webpatiser\Uuid\Uuid;

class BeatsController extends Controller
{
    public function index(){
        
        return view('management.beats.index')->with('beats', Beat::all());
    }
    public function create(){
        if(Category::count() == 0){
            return redirect()->route('categories.index')
                ->with('error', 'You need to add atleast once beat genre!');
        }
        return view('management.beats.create')->with('categories', Category::all());
    }
    public function upload(BeatFormRequest $request){
      
        
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
            'uuid' => (string)\Uuid::generate(4),
            'u_name' => Auth::guard('admin')->user()->name
            
        ]);

        if($beat) {
            return redirect()->route('beats.index')->with('success', 'beat added nicely');
        }
    }

    public function show($id){
        $beat = Beat::findOrFail($id);
        return view('management.beats.show', compact('beat'));
    }
    public function edit($id){
        $beat = Beat::findOrFail($id);
        $categories = Category::all();
        return view('management.beats.create', compact('beat','categories'));
    }
    public function update(BeatFormRequest $request, $id){
        
        $beat = Beat::findOrFail($id);

        if($request->hasFile('beat')){
            $beatNameWithExt = request()->file('beat')->getClientOriginalName();
            $beatName = pathinfo($beatNameWithExt, PATHINFO_FILENAME);
            $extension = request()->file('beat')->getClientOriginalExtension();
            $beatNameToStore = $beatName.time().".".$extension;
            request()->file('beat')->move(base_path().'/public/Uploads/Beats', $beatNameToStore);

            if(file_exists($beat->location)){
                unlink($beat->location);
            }

            $beat->location = 'Uploads/Beats/'. $beatNameToStore;
        }
        
        $this->saveCoverImage($beat);
        
        if($request->market == 'free'){
            $amt = 0;
        }else{
            $amt = $request->amount;
        }
      
        $beat->title = $request->title;
        $beat->producer = $request->producer;
        $beat->category_id = $request->category_id;
        $beat->released_date = $request->released_date;
        $beat->market = $request->market;
        $beat->amount = $amt;
        $beat->saveOrFail();

        if($beat) {
            return redirect()->route('beats.show', $beat->id)->with('success', 'beat updated success');
        }
    }
}
