<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\Products\Contracts\ReviewService;
use Modules\Products\Requests\StoreReviewRequest;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(StoreReviewRequest $request)
    {
        $this->reviewService->createByUser($request->all(), auth()->user());

        return back();
    }
}
