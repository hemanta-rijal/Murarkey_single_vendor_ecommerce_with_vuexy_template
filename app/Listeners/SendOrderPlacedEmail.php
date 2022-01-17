<?php

namespace App\Listeners;

use App\Events\OrderPlacedEvent;
use App\Mail\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderPlacedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderPlacedEvent $event)
    {
        Mail::to($event->user->email)->send(new OrderPlaced($event->order,$event->user));
    }
}
