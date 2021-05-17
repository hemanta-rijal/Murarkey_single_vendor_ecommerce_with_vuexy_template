<?php

namespace App\Listeners;

use App\Events\BoughtFromDiscount;
use App\Models\Subscription;

class DiscountHandler
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
     * @param  BoughtFromDiscount $event
     * @return void
     */
    public function handle(BoughtFromDiscount $event)
    {
        Subscription::where('email', $event->user->email)->update(['discount_used' => 1]);
    }
}
