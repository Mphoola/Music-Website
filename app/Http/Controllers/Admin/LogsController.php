<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    public function index(){
        return view('management.logs.index')
            ->with('logs', Activity::orderBy('created_at', 'desc')->paginate(20));
    }

    public function user_logs($id, $g){
        if($g == 'Admin'){
            $user = Admin::findOrFail($id);
            $logs = $user->actions;
        }elseif($g == 'User'){
            $user = User::findOrFail($id);
            $logs = $user->actions;
        }
        
        return view('management.logs.user_logs')
            ->with('logs', $logs)
            ->with('user', $user);
    }
}
