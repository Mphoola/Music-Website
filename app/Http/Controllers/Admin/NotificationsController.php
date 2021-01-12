<?php

namespace App\Http\Controllers\Admin;

use App\Beat;
use App\Http\Controllers\Controller;
use App\Song;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index(){
        $notifications = auth()->guard('admin')->user()->notifications()->orderBy('created_at','asc')->simplePaginate(10);
        return view('management.notifications.index', compact('notifications'));
    }

    public function show($id, $m, $t){
        Auth::guard('admin')->user()->unReadNotifications->where('id', $id)->markAsRead();
        if($t == 'video'){
            $video = Video::findOrFail($m);
            return view('management.notifications.show')->with('video', $video);
        }

        if($t == 'song'){
        
            $song = Song::findOrFail($m)->load('category', 'comments');
            $size = $this->getFileSize($song->location);
            return view('management.audios.show', compact('song', 'size'));
        }

        if($t == 'beat'){
            $beat = Beat::findOrFail($m);
            $size = $this->getFileSize($beat->location);
            return view('management.beats.show', compact('beat', 'size'));
        }
    }

    public function markAsRead($id){
        Auth::guard('admin')->user()->unReadNotifications->where('id', $id)->markAsRead(); 
        return redirect()->back()->with('success', 'notification marked as read'); 
    }
    public function markAllAsRead(){
        Auth::guard('admin')->user()->unReadNotifications->markAsRead(); 
        return redirect()->back()->with('success', 'All unread notifications has been marked as read'); 
    }
    public function delete($id){
        Auth::guard('admin')->user()->notifications()->where('id', $id)->delete();
        return redirect()->back()->with('success', 'notification deleted');  
    }
    public function deleteAll(){
        Auth::guard('admin')->user()->notifications()->delete();;
        return redirect()->back()->with('success', 'notification deleted');  
    }
}