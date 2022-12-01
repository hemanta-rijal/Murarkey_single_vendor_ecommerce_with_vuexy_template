<?php

namespace Modules\Products\Contracts;


interface ReviewService
{

    public function createByUser($data, $user);

    public function canReview($user, $productId,$type);

    public function getLatestReviewsForProduct($productId);

    public function getReviewsInfo($productId);

}