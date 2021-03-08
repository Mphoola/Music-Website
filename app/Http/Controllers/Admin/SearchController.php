<?php

namespace App\Http\Controllers\Admin;

use App\Beat;
use App\Song;
use App\Video;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function beat_search(Request $request){

        $searchResults = (new Search())
            ->registerModel(Beat::class, 'title')
            ->perform($request->input('query'));

        return view('management.beats.search', compact('searchResults'));
    }

    public function song_search(Request $request){

        $searchResults = (new Search())
            ->registerModel(Song::class, 'title')
            ->registerModel(Song::class, 'artist')
            ->perform($request->input('query'));

        return view('management.audios.search', compact('searchResults'));
    }

    public function video_search(Request $request){

        $searchResults = (new Search())
            ->registerModel(Video::class, 'title')
            ->registerModel(Video::class, 'artist')
            ->perform($request->input('query'));

        return view('management.videos.search', compact('searchResults'));
    }
    public function post_search(Request $request){

        $searchResults = (new Search())
            ->registerModel(Post::class, 'title')
            ->perform($request->input('query'));

        return view('management.blog.search', compact('searchResults'));
    }
}
