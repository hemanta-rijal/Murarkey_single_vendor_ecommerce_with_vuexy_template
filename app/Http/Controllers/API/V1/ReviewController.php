<?php

namespace App\Http\Controllers\API\V1;


use App\Http\ApiRequests\ReviewRequest;
use Modules\Products\Contracts\ReviewService;
use Modules\Products\Requests\CanReviewRequest;

class ReviewController extends BaseController
{
    private $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(ReviewRequest $request)
    {
        return $this->reviewService->createByUser($request->all(), $this->auth->user());
    }


    public function canReview(CanReviewRequest $request)
    {
        return ['can_review' => $this->reviewService->canReview($this->auth->user(), $request->product_id)];
    }

}