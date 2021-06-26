<?php

namespace App\Http\Controllers;

use App\Models\LocationAreaCode;
use Modules\Location\Contracts\LocationService;
use Modules\Location\Requests\GetLocationInfoRequest;

class LocationController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function getInfo(GetLocationInfoRequest $request)
    {
        $data = $request->all();

        return $this->locationService->getInfo($data);
    }

    public function getAreaCode()
    {
        return LocationAreaCode::pluck('area_code', 'area_code');
    }

}
