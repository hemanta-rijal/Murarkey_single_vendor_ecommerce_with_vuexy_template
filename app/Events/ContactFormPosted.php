<?php

namespace App\Events;

use App\Models\ContactUs;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ContactFormPosted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $contactUsObj;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ContactUs $contactUs)
    {
        $this->contactUsObj = $contactUs;
    }
    
}
