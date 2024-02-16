<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PinStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $number;
    public $name;
    public $newStatus;

    /**
     * Create a new event instance.
     */
    public function __construct($number,$name, $newStatus)
    {
        $this->number = $number;
        $this->name = $name;
        $this->newStatus = $newStatus;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('public.pin');

    }

    public function broadcastAs()
    {
        return 'pin-status-updated';
    }


    public function broadcastWith()
    {
        return [
            'pin_number' => $this->number,
            'name' => $this->name,
            'status' => $this->newStatus,
        ];
    }
}
