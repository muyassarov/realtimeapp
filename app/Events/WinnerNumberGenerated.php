<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WinnerNumberGenerated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $number;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        Log::debug("Winner number $this->number");
        return new Channel('game');
    }
}
