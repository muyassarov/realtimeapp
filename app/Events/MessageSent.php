<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;

    public string $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $message)
    {
        $this->user    = $user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        Log::debug("{$this->user->name}: $this->message");
        return new PresenceChannel('chat');
    }
}
