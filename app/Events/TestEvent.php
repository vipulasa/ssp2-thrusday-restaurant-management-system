<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct()
    {
        $this->message = 'test';
    }

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('my-channel')
        ];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
