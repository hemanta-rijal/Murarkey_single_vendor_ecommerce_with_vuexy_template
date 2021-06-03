<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\slides\SlideResource;
use Modules\Admin\Contracts\SliderService;

class SlidesController extends BaseController
{
    private $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * Slides
     *
     * get all slides
     *
     * @Get("/slides")
     * @Versions({"v1"})
     */

    public function index()
    {
        return SlideResource::collection($this->sliderService->getSlides());
        // return $this->sliderService->getSlides();
    }

    public function getSlide($id)
    {
        return new SlideResource($this->sliderService->findById($id));
    }

}
