<?php

namespace App\Listeners;

use App\Admin;
use App\Notifications\newBeatUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class sendBeatNotToAdminListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = Admin::permission('can be notified about beats')->get();
        Notification::send($admins, new newBeatUploaded($event->beat));
    }
}
