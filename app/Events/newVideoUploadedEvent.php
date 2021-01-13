<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class newVideoUploadedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $video;
    public function __construct($video)
    {
        $this->video = $video;
    }

}
