<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index(){
        $notifications = auth()->guard('admin')->user()->notifications()->orderBy('created_at','asc')->simplePaginate(10);
        return view('management.notifications.index', compact('notifications'));
    }

    public function show($id, $v){
        Auth::guard('admin')->user()->unReadNotifications->where('id', $id)->markAsRead();
        $video = Video::findOrFail($v);
        return view('management.notifications.show')->with('video', $video);
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