<?php

namespace App\Providers;

use App\Events\newBeatUploadedEvent;
use App\Events\newsongUploadedEvent;
use App\Events\newVideoUploadedEvent;
use App\Listeners\sendBeatNotToAdminListener;
use App\Listeners\sendSongNotToAdminListener;
use App\Listeners\sendVideoNotToAdminListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        newVideoUploadedEvent::class => [
            sendVideoNotToAdminListener::class
        ],
        newsongUploadedEvent::class => [
            sendSongNotToAdminListener::class
        ],
        newBeatUploadedEvent::class => [
            sendBeatNotToAdminListener::class
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
