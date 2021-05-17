<?php

namespace App\Listeners;

use App\Events\ProductCategoryChanged;
use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use Modules\Categories\Contracts\CategoryRepository;

class UpdateCategoryProductCount
{
    protected $categoryRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Handle the event.
     *
     * @param  ProductCategoryChanged $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof ProductDeleted) {
            $type = 'decrement';
            $categoryId = $event->product->category_id;

            $this->categoryRepository->alterProductCount($type, $categoryId);
        } elseif ($event instanceof ProductCreated) {
            $type = 'increment';
            $categoryId = $event->product->category_id;

            $this->categoryRepository->alterProductCount($type, $categoryId);
        } elseif ($event instanceof ProductCategoryChanged) {
            \DB::transaction(function () use ($event) {
                $this->categoryRepository->alterProductCount('increment', $event->to);
                $this->categoryRepository->alterProductCount('decrement', $event->from);
            });

        }

    }
}
