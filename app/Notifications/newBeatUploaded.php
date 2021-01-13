<?php

namespace App\Notifications;

use App\Beat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class newBeatUploaded extends Notification
{
    use Queueable;
    public $beat;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Beat $beat)
    {
        $this->beat = $beat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'beat_id' => $this->beat->id,
            'beat_details' => $this->beat->full_details,
            'uploader_name' => $this->beat->user->name
        ];
    }
}
