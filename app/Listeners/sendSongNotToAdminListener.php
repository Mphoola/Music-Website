<?php

namespace App\Listeners;

use App\Admin;
use App\Notifications\newSongUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class sendSongNotToAdminListener
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
        $admins = Admin::permission('can be notified about songs')->get();
        Notification::send($admins, new newSongUploaded($event->song));
    }
}
