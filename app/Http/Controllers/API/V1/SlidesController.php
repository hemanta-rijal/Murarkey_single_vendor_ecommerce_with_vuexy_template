<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 9/3/18
 * Time: 12:11 PM
 */

namespace App\Http\Controllers\API\V1;


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
        return $this->sliderService->getSlides();
    }
}