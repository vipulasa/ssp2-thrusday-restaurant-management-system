<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class DatabaseSampleNotification extends Notification
{
    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => 'This is a sample notification xxxxx',
        ];
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
