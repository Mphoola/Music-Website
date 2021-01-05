<?php

namespace App\Http\Controllers;
use Youtube;
use Illuminate\Http\Request;

class YouController extends Controller
{
    public function index()
        {
            return view('video');
        }

        public function store(Request $request)
        {
            $video = \Youtube::upload($request->file('video')->getPathName(), [
                'title'       => $request->input('title'),
                'description' => $request->input('description')
            ]);
     
            return "Video uploaded successfully. Video ID is ". $video->getVideoId();
        }
}
