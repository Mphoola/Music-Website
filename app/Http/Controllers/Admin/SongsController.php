<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\SongFormRequest;
use App\Repositories\Admin\Implementations\SongRepository;
use App\Song;

class SongsController extends Controller
{
    private $songRepository;

    public function __construct(SongRepository $songRepository)
    {
        $this->songRepository = $songRepository;
    }

    public function index(){
        $songs = $this->songRepository->all();
        return view('management.audios.index')
            ->with('songs', $songs);
    }
    public function create(){
        
        $this->checkCategoriesCount(); 
        return view('management.audios.create')
            ->with('categories', Category::all());
    }
    public function upload(SongFormRequest $request){    

        $song = $this->songRepository->store($request->all());
        if($song) {
            return redirect()->route('songs.index')->with('success', 'Song added nicely');
        }
    }

    public function show($id){
        $song = Song::findOrFail($id)->load('category', 'comments');
        $size = $this->getFileSize($song->location);
        return view('management.audios.show', compact('song', 'size'));
    }
    public function edit($id){
        $song = Song::findOrFail($id);
        $categories = Category::all();
        return view('management.audios.create', compact('song','categories'));
    }
    public function update(SongFormRequest $request, $id){
        
        $song = $this->songRepository->update($id, $request->all());

        if($song) {
            return redirect()->route('songs.show', $song->id)->with('success', 'Song updated success');
        }
    }

    public function delete($id){
        if(Song::findOrFail($id)->delete()){
            return redirect()->route('songs.index')->with('success', 'Song Deleted');
        }
    }

}
