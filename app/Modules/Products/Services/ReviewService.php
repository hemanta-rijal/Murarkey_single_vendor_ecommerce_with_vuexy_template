<?php

namespace Modules\Products\Services;

use Modules\Products\Contracts\ProductReviewRepository;
use Modules\Products\Contracts\ReviewService as ReviewServiceContract;

class ReviewService implements ReviewServiceContract
{
    private $reviewRepository;

    public function __construct(ProductReviewRepository $productReviewRepository)
    {
        $this->reviewRepository = $productReviewRepository;
    }

    public function createByUser($data, $user)
    {
        $data['user_id'] = $user->id;
        $data['comment'] = strip_tags($data['comment']);
        if(isset($data['product_id'])){
            $data['reviewable_id'] = $data['product_id'];
            $data['reviewable_type'] = "App\Models\Product";
        }
        if (isset($data['service_id'])){
            $data['reviewable_id'] = $data['service_id'];
            $data['reviewable_type'] = "App\Models\Service";
        }
        return $this->reviewRepository->create($data);
    }

    public function canReview($user, $productId)
    {
        return $this->reviewRepository->canReview($user->id, $productId);
    }

    public function getLatestReviewsForProduct($productId)
    {
        return $this->reviewRepository->getLatestReviewsForProduct($productId);
    }

    public function getReviewsInfo($productId)
    {
        return $this->reviewRepository->getReviewsInfo($productId);
    }

}
