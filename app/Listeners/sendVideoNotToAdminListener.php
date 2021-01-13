<?php

namespace App\Listeners;

use App\Admin;
use App\Notifications\newVideoUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class sendVideoNotToAdminListener
{
    
    public function handle($event)
    {
        $admins = Admin::permission('approve video')->get();
        Notification::send($admins, new newVideoUploaded($event->video));
    }
}
