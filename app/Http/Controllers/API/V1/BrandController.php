<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Brand\BrandResource;
use Modules\Brand\Services\BrandService;

class BrandController extends Controller
{
    private $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    public function getFeaturedbrands()
    {
        $brands = $this->brandService->getAllFeatured();
        return new BrandResource($brands);
    }
}
