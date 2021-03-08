<?php

namespace App\Http\Controllers\FrontEnd;

use App\Beat;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeatsController extends Controller
{
    public function index(){
        $beats = Beat::withCount('comments')
            ->where('market', 'free')
            ->orderBy('released_date', 'desc')
            ->paginate(12);
        $most_downloads = $this->most_donwloads();
        
        return view('frontEnd.beats')
            ->with('categories', Category::all())
            ->with('beats', $beats)
            ->with('most_downloads', $most_downloads);
    }

    public function show($f, $beat){
       
        $beat = Beat::findBeat($beat);
        $size = $this->getFileSize($beat->location);
        $beat->load('comments');
        $most_downloads = $this->most_donwloads();

        return view('frontEnd.singleBeat')
            ->with('categories', Category::all())
            ->with('beat', $beat)
            ->with('size', $size)
            ->with('most_downloads', $most_downloads);
    }

    public function download($id){
        $b = Beat::findBeat($id);
        
        return $this->downloadFile($b);    
    }

    public function comment(Request $request,$id){
        $b = Beat::findOrFail($id);

       if($b){
        $b->comments()->create([
            'creator_name' => $request->creator_name,
            'creator_email' => $request->creator_email,
            'content' => $request->content,
        ]);
        return redirect()->back()->with('success', 'You have successfully commented');
       }
    }

    public function showByCategory(Category $category){
       
        $bts = $category->beats()->withCount('comments')->paginate(12);

        $most_downloads = $this->most_donwloads();
        return view('frontEnd.beats')
            ->with('categories', Category::all())
            ->with('bts', $bts)
            ->with('most_downloads', $most_downloads)
            ->with('category', $category->name);
    }

    private function most_donwloads(){
        return Beat::where('market', 'free')->orderBy('downloads_count', 'desc')->take(5)->get();
    }
}
