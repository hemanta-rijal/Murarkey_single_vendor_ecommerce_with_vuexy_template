<?php

namespace App\Listeners;

use App\Events\SellerOrderNoUpdated;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SellerOrderNoListener
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
     * @param  SellerOrderNoUpdated  $event
     * @return void
     */
    public function handle(SellerOrderNoUpdated $event)
    {
        $event->order->status = OrderItem::ORDER_PRE_PROCESSING;



        $event->order->save();
    }
}
