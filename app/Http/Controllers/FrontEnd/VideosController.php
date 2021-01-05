<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index(){
        $vedios = Video::withCount('comments')->where('market', 'free')->where('verified', '1')->paginate(12);
        $most_downloads = $this->most_downloads();
        
        return view('frontEnd.videos')
            ->with('categories', Category::all())
            ->with('videos', $vedios)
            ->with('most_downloads', $most_downloads);
    }

    public function show($id){
        $video = Video::findVideo($id);
        $size = $this->getFileSize($video->location);
        $video->load('comments', 'category');
        $most_downloads = $this->most_downloads();
        return view('frontEnd.singleVideo')
            ->with('categories', Category::all())
            ->with('video', $video)
            ->with('size', $size)
            ->with('most_downloads', $most_downloads);
    }

    public function download($id){
        $v = Video::findVideo($id);
        
        return $this->downloadFile($v);    
    }

    public function comment(Request $request, $id){
        $v = Video::findVideo($id);
        
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
        $most_downloads = $this->most_downloads();
        $vids = $category->videos()->withCount('comments')->where('market', 'free')->where('verified', '1')->paginate(12);
        return view('frontEnd.videos')
            ->with('categories', Category::all())
            ->with('vids', $vids)
            ->with('most_downloads', $most_downloads)
            ->with('category', $category->name);
    }

    private function most_downloads(){
        return Video::where('market', 'free')->where('verified', '1')->orderBy('downloads_count', 'desc')->take(5)->get();
    }
}
