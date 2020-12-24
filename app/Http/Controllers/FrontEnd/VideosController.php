<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index(){
        $vedios = Video::withCount('downloads', 'comments')->paginate(8);
        $most_downloads = Video::withCount('downloads')->orderBy('downloads_count', 'desc')->take(5)->get();
        
        return view('frontEnd.videos')
            ->with('categories', Category::all())
            ->with('videos', $vedios)
            ->with('most_downloads', $most_downloads);
    }

    public function show($id){
        $video = Video::where('uuid', $id)->firstOrFail();
        $video->load('downloads', 'comments');
        $most_downloads = Video::withCount('downloads')->orderBy('downloads_count', 'desc')->take(5)->get();
        return view('frontEnd.singleVideo')
            ->with('categories', Category::all())
            ->with('video', $video)
            ->with('most_downloads', $most_downloads);
    }

    public function download($id){
        $v = Video::where('uuid', $id)->firstOrFail();
        if($v){
            $v->downloads()->create();
            $loc = public_path().'/'. $v->location;
       
            // Storage::download($b->location, $name);
           return response()->download($loc);
        }
           
    }

    public function comment(Request $request, $id){
        $v = Video::where('uuid', $id)->firstOrFail();
        
       if($v){
        $v->comments()->create([
            'creator_name' => $request->creator_name,
            'creator_email' => $request->creator_email,
            'content' => $request->content,
        ]);
        return redirect()->back()->with('success', 'You have successfully commented');
       }
    }

    public function showByCategory(Category $category){
        $most_downloads = Video::withCount('downloads')->orderBy('downloads_count', 'desc')->take(5)->get();
        $vids = $category->videos;
        return view('frontEnd.videos')
            ->with('categories', Category::all())
            ->with('vids', $vids)
            ->with('most_downloads', $most_downloads)
            ->with('category', $category->name);
    }
}
