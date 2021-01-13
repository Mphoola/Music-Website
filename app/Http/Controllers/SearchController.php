<?php

namespace App\Http\Controllers;

use App\Beat;
use App\Category;
use App\Post;
use App\Song;
use App\Video;
use Illuminate\Http\Request as ClientRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function index(ClientRequest $request){
        $searchResults = (new Search())
            ->registerModel(Beat::class, 'title')
            ->registerModel(Song::class, 'artist')
            ->registerModel(Song::class, 'title')
            ->registerModel(Video::class, 'title')
            ->registerModel(Video::class, 'artist')
            ->registerModel(Post::class, 'title')
            ->registerModel(Category::class, 'name')
            ->perform($request->input('query'));

            $most_downloads = Song::where('market', 'free')
                ->orderBy('downloads_count', 'desc')->take(5)->get();
            $categories = Category::all();
            $random = DB::table('songs')->where('market', 'free')->inRandomOrder()->take(8)->get();
        return view('frontEnd.searchResult', compact('searchResults', 'most_downloads', 'categories', 'random'));
    }
}
