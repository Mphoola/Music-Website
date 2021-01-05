<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Beat;
use App\Http\Controllers\Controller;
use App\Song;
use App\Post;
use App\User;
use App\Video;

class DashboardController extends Controller
{
    public function index(){
        $songs = Song::count();
        $beats = Beat::count();
        $videos = Video::count();
        $users = User::count();
        $blogs = Post::count();
        return view('management.dashboard', compact('songs', 'beats', 'videos', 'users', 'blogs'));
    }

    
    
}
