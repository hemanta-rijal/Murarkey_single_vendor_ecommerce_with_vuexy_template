<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Parlour\ParlourResource;
use Modules\ParlourListings\Services\ParlourListingService;

class ParlourController extends Controller
{
    private $parlourService;

    public function __construct(ParlourListingService $parlourService)
    {
        $this->parlourService = $parlourService;
    }
    public function getFeaturedParlours()
    {
        $parlours = $this->parlourService->getAllFeatured();
        return ParlourResource::collection($parlours);
    }
    public function show($id){
        $parlours = $this->parlourService->findById($id);
        return new ParlourResource($parlours);
    }
}
