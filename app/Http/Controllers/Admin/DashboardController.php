<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Beat;
use App\Http\Controllers\Controller;
use App\Song;
use App\User;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $songs = Song::count();
        $beats = Beat::count();
        $videos = Video::count();
        $users = User::count();
        return view('management.dashboard', compact('songs', 'beats', 'videos', 'users'));
    }

    
    
}
