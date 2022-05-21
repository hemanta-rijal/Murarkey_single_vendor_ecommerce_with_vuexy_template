<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Service\ServiceCategoryResource;
use App\Http\Resources\Service\ServiceResource;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;
use Modules\Service\Contracts\ServiceService;

class ServiceController extends Controller
{
    private $servicesService;
    private $servicesCategoryService;
    public function __construct(ServiceService $service, ServiceCategoryService $serviceCategoryService)
    {
        $this->servicesCategoryService = $serviceCategoryService;
        $this->servicesService = $service;
    }
    public function index()
    {
        $services = $this->servicesService->getAll();
        return ServiceResource::collection($services);
    }
    public function getTree()
    {
        $services_categories = $this->servicesCategoryService->getTree();
        return ServiceCategoryResource::collection($services_categories);
    }

    public function getById($id)
    {
        $service = $this->servicesService->findById($id);
        if ($service) {
            return new ServiceResource($service);
        }

    }

    public function popularServices()
    {
        return ServiceResource::collection($this->servicesService->getPopularServices());
    }

    public function servicesByCategoryId($id)
    {
        $serviceCategory = $this->servicesCategoryService->findById($id);
        $services = $serviceCategory->services;
        if ($services) {
            return ServiceResource::collection($services);
        }

    }

    public function topLevelCategory(){
        $parentCateogry = $this->servicesCategoryService->getParentCategoryOnly();
        return response()->json(['data'=>ServiceCategoryResource::collection($parentCateogry)],200);
    }

    public function search(){
        $services = $this->servicesService->searchBar(); //filters by slug attr(s)
        $total_products_count = $this->servicesService->getMurarkeyService()->count();
        $searched_products_count = $services->count();
        return response()->json(['data'=>ServiceResource::collection($services),'total_products_count'=>$total_products_count,'searched_products_count'=>$searched_products_count]);
        return ;
    }
}
