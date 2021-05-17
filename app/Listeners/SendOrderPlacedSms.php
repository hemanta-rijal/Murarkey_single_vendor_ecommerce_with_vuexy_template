<?php

namespace App\Listeners;

use App\Events\OrderPlacedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderPlacedSms
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
     * @param  OrderPlacedEvent  $event
     * @return void
     */
    public function handle(OrderPlacedEvent $event)
    {
        $mobileNumber = $event->order->shipment_details['phone_number'];
        sendSms($mobileNumber, "Your Order #{$event->order->id} has been placed. The shipment will be delivered within {$event->order->delivery_date} KABMART");
    }
}
