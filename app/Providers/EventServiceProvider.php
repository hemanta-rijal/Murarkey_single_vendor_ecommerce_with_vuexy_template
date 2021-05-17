<?php

namespace App\Providers;

use App\Events\ProductCategoryChanged;
use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use App\Listeners\UpdateCategoryProductCount;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Illuminate\Auth\Events\Registered::class => [\App\Listeners\RegisteredUserListener::class],
        ProductDeleted::class => [UpdateCategoryProductCount::class],
        ProductCreated::class => [UpdateCategoryProductCount::class],
        ProductCategoryChanged::class => [UpdateCategoryProductCount::class],
        \Illuminate\Auth\Events\Login::class => [\App\Listeners\InitializeCart::class],
        \App\Events\CheckoutFromCartEvent::class => [\App\Listeners\ClearCartHandler::class],
        \App\Events\BoughtFromDiscount::class => [\App\Listeners\DiscountHandler::class],
        \App\Events\OrderPlacedEvent::class => [\App\Listeners\ManageShipmentDetail::class, \App\Listeners\SendOrderPlacedSms::class],
        \App\Events\SellerOrderNoUpdated::class => [\App\Listeners\SellerOrderNoListener::class],
        \App\Events\SellerAWBNoUpdated::class => [\App\Listeners\SellerAWBNoListener::class],
        \App\Events\OrderShipped::class => [\App\Listeners\SendOrderShippedSms::class]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
