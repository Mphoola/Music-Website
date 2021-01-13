<?php

namespace App\Http\Controllers\Admin;

use App\Beat;
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
}
