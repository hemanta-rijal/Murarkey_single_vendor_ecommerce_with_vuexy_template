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