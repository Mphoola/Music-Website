<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoFormRequest;
use App\Repositories\Admin\Implementations\videoRepository;
use App\Video;

class VideosController extends Controller
{
    private $videoRepository;
    public function __construct(videoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
    public function index(){
        $videos = $this->videoRepository->all();
        return view('management.videos.index')
            ->with('videos', $videos);
    }
    public function create(){
        $this->checkCategoriesCount();
        return view('management.videos.create')
            ->with('categories', Category::all());
    }
    public function upload(VideoFormRequest $request){
        $video = $this->videoRepository->store($request->all());

        if($video) {
            return redirect()->route('videos.index')->with('success', 'video added nicely');
        }
    }

    public function show($id){
        $video = Video::findOrFail($id);
        $size = $this->getFileSize($video->location);
        return view('management.videos.show', compact('video', 'size'));
    }
    public function edit($id){
        $video = Video::findOrFail($id);
        $categories = Category::all();
        return view('management.videos.create', compact('video','categories'));
    }
    public function update(VideoFormRequest $request, $id){
       
       $video = $this->videoRepository->update($id, $request->all());

        if($video) {
            return redirect()->route('videos.show', $video->id)->with('success', 'video updated success');
        }
    }

    public function delete($id){
        if(Video::findOrFail($id)->delete()){
            return redirect()->route('videos.index')->with('success', 'Video Deleted');
        }
    }

}
