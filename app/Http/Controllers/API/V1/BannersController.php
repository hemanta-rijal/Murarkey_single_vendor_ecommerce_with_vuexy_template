<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Banner\BannerResource;
use Modules\Admin\Services\BannerService;

class BannersController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }
    public function getAllByPosition($positon)
    {
        $banners = $this->bannerService->findAllByPosition($positon);
        return BannerResource::collection($banners);
    }
    public function getByPosition($position)
    {
        $banner = $this->bannerService->findByPosition($position);
        return BannerResource::collection($banner);

    }

}
