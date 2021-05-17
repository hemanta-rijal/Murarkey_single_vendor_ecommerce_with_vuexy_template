<?php

namespace App\Listeners;

use App\Events\CheckoutFromCartEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Cart;

class ClearCartHandler
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
     * @param  CheckoutFromCartEvent  $event
     * @return void
     */
    public function handle(CheckoutFromCartEvent $event)
    {
        Cart::destroy();
        Cart::store($event->user->id);
    }
}
