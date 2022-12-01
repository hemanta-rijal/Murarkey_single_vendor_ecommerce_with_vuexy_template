<?php

namespace App\Http\Controllers\API\V1;


use App\Http\ApiRequests\ReviewRequest;
use Modules\Products\Contracts\ReviewService;
use Modules\Products\Requests\CanReviewRequest;
use Modules\Users\Contracts\UserService;

class ReviewController extends BaseController
{
    private $reviewService;
    private $userServices;

    public function __construct(ReviewService $reviewService,UserService $userServices)
    {
        $this->reviewService = $reviewService;
        $this->userServices = $userServices;
    }

    public function store(ReviewRequest $request)
    {
        if(get_can_review($this->userServices->getLogedInUser(),$request->product_id,$type=null)){
            if($this->reviewService->createByUser($request->all(), $this->userServices->getLogedInUser())){
                return response()->json(['data'=>'','message'=>'Review Submitted Successfully!']);
            }
        }
        return response()->json(['data'=>'','message'=>'You are not authorize to submit a review!!']);

       
    }


    public function canReview(CanReviewRequest $request)
    {
        return ['can_review' => $this->reviewService->canReview($this->auth->user(), $request->product_id)];
    }

}