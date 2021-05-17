<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Models\OrderItem;

class SendOrderShippedSms
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $masterOrder = $event->order->order;

        $cc = $masterOrder->items->filter(function ($item) {
            return $item->status == OrderItem::ORDER_SHIPPED || $item->status == OrderItem::ORDER_DISPATCH;
        })->count() + 1;

        $oo = $cc === 1 ? 'item' : 'items';

        $text = "{$cc} {$oo} of order #{$masterOrder->id} has been shipped. KABMART";

        sendSms($event->order->order->user->phone_number, $text);
    }
}
