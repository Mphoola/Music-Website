<?php

namespace App\Http\Controllers\FrontEnd;

use App\Beat;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeatsController extends Controller
{
    public function index(){
        $beats = Beat::withCount('downloads', 'comments')->where('market', 'free')->paginate(8);
        $most_downloads = Beat::withCount('downloads')->where('market', 'free')->orderBy('downloads_count', 'desc')->take(5)->get();
        
        return view('frontEnd.beats')
            ->with('categories', Category::all())
            ->with('beats', $beats)
            ->with('most_downloads', $most_downloads);
    }

    public function show($beat){
       
        $beat = Beat::where('uuid', $beat)->firstOrFail();
        $beat->load('downloads', 'comments');
        $most_downloads = Beat::withCount('downloads')->where('market', 'free')->orderBy('downloads_count', 'desc')->take(5)->get();

        return view('frontEnd.singleBeat')
            ->with('categories', Category::all())
            ->with('beat', $beat)
            ->with('most_downloads', $most_downloads);
    }

    public function download($id){
        $b = Beat::where('uuid', $id)->firstOrFail();
        
        if($b){
            $b->downloads()->create();
            $loc = public_path().'/'. $b->location;
       
            // Storage::download($b->location, $name);
           return response()->download($loc);
        }
           
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

        $bts = $category->beats;

        $most_downloads = Beat::withCount('downloads')->where('market', 'free')->orderBy('downloads_count', 'desc')->take(5)->get();
        return view('frontEnd.beats')
            ->with('categories', Category::all())
            ->with('bts', $bts)
            ->with('most_downloads', $most_downloads)
            ->with('category', $category->name);
    }
}
