<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductCategoryChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $to;
    public $from;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($array)
    {
        $this->to = $array['to'];
        $this->from = $array['from'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
