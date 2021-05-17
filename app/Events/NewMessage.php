<?php

namespace App\Events;

use App\Models\MsgGeneralMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Musonza\Chat\Messages\Message;

class NewMessage implements ShouldBroadcast
{
    use  SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('conversation.' . $this->message->conversation_id, $this->message);
    }
}
