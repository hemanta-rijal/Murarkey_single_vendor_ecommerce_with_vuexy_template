<?php


namespace App\Http\Controllers\API\V1;


use Dingo\Api\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends BaseController
{
    /**
     * Get Resize Image
     *
     * Get resize image url
     * @Parameters({
     *      @Parameter("type", description="example 200X200", default="200X200"),
     *      @Parameter("path", description="path of image")
     * })
     * @Get("/resize-image")
     * @Versions({"v1"})
     */
    public function image(Request $request)
    {
        if ($request->get('path') && $request->get('type'))
            return resize_image_url($request->get('path'), $request->get('type'));

    }
}