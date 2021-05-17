<?php

namespace App\Listeners;

use App\Events\SellerAWBNoUpdated;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SellerAWBNoListener
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
     * @param  SellerAWBNoUpdated  $event
     * @return void
     */
    public function handle(SellerAWBNoUpdated $event)
    {
        $event->order->status = OrderItem::ORDER_PROCESSING;

        $event->order->save();
    }
}
