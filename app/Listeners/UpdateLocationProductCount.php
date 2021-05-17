<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use Modules\Location\Contracts\LocationRepository;

class UpdateLocationProductCount
{
    protected $locationRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Handle the event.
     *
     * @param  ProductCreated $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof ProductDeleted) {
            $type = 'decrement';
            $cityId = $event->product->company->city;

            $this->locationRepository->alterProductCount($type, $cityId);
        } elseif ($event instanceof ProductCreated) {
            $type = 'increment';
            $cityId = $event->product->company->city;

            $this->locationRepository->alterProductCount($type, $cityId);
        }

    }
}