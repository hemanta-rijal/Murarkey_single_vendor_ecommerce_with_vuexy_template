<?php

namespace Modules\Products\Repositories;

use App\Models\Order;
use App\Models\Review;
use Modules\Products\Contracts\ProductReviewRepository;

class DbProductReviewRepository implements ProductReviewRepository
{
    public function delete($id)
    {
        $review = Review::findOrFail($id);

        $review->delete();
    }

    public function findById($id)
    {
        return Review::findOrFail($id);
    }

    public function update($id, $data)
    {
        $review = Review::findOrFail($id);

        $review->fill($data);

        $review->save();

        return $review;
    }

    public function create($data)
    {
        $review = new Review();

        $review->fill($data);

        $review->save();

        return $review;
    }

    public function canReview($userId, $productId)
    {
        // return Order::join('order_item', 'order_item.order_id', '=', 'orders.id')->where('user_id', $userId)->where('product_id', $productId)->exists() && !Review::where('user_id', $userId)->where('product_id', $productId)->exists();
        return Order::join('order_item', 'order_item.order_id', '=', 'orders.id')->where('user_id', $userId)->where('product_id', $productId)->exists();
    }

    public function getReviewsInfo($productId)
    {
        return Review::select(\DB::raw('count(id) as review_count'), 'rating')->where('product_id', $productId)->groupBy('rating')->orderBy('rating', 'DESC')->get();
    }

    public function getLatestReviewsForProduct($productId)
    {
        return Review::orderBy('rating', 'DESC')->latest()->take(10)->get();
    }

}
