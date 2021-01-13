<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Beat;
use App\Song;
use App\Post;
use App\User;
use App\Video;

class DashboardController extends Controller
{
    public function index(){
                
        $chart_options_songs = [
            'chart_title' => 'Song Uploads By month',
            'report_type' => 'group_by_date',
            'model' => 'App\Song',
            'group_by_field' => 'released_date',
            'group_by_period' => 'month',
            'chart_type' => 'line',
            
        ];
        $chart_options_posts = [
            'chart_title' => 'Blogs Published By month',
            'report_type' => 'group_by_date',
            'model' => 'App\Post',
            'group_by_field' => 'published_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',
        ];
        $chart_options_beats = [
            'chart_title' => 'Beats Uploads by month',
            'report_type' => 'group_by_date',
            'model' => 'App\Beat',
            'group_by_field' => 'released_date',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $chart_options_videos = [
            'chart_title' => 'Video Uploads by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Video',
            'group_by_field' => 'released_date',
            'group_by_period' => 'month',
            'chart_type' => 'line',
        ];

       
        $music_chart = new LaravelChart($chart_options_songs);
        $beat_chart = new LaravelChart($chart_options_beats);
        $video_chart = new LaravelChart($chart_options_videos);
        $blog_chart = new LaravelChart($chart_options_posts);

        $songs = Song::count();
        $beats = Beat::count();
        $videos = Video::count();
        $users = User::count();
        $blogs = Post::count();
        return view('management.dashboard', 
            compact('songs', 'beats', 'videos', 'users', 
            'blogs', 'music_chart', 'beat_chart', 'video_chart', 'blog_chart'));
    }

    
    
}
