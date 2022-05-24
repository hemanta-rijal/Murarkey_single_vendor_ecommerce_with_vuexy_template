<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Modules\Service\Services\ServiceService;
use Modules\ServiceCategories\Services\ServiceCategoryService;

class ServiceController extends Controller
{
    private $serviceService,$serviceCategory;
    public function __construct(ServiceService $serviceService, ServiceCategoryService $serviceCategory)
    {
        $this->serviceService = $serviceService;
        $this->serviceCategory = $serviceCategory;
    }

    public function autocompleteSearch(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $services = Service::orderby('title', 'asc')->select('id', 'title', 'price', 'slug')->limit(5)->get();
        } else {
            $services = Service::orderby('title', 'asc')->select('id', 'title', 'price', 'slug')->where('title', 'like', '%' . $search . '%')->limit(5)->get();
        }
        $response = array();
        if ($services->count() > 0) {
            foreach ($services as $service) {
                $url = URL::to('service-detail/' . $service->id);
                $image = $service->featured_image ? resize_image_url($service->featured_image, '50X50') : null;
                $response[] = array("id" => $service->id, "name" => $service->name, "value" => $service->name, "label" => "<a href='$url'><img src='$image'> &nbsp; $service->title &nbsp; &nbsp; <strong>Rs. $service->price</strong></a>");
            }
        } else {
            $response[] = array("value" => '', 'label' => 'No Result Found');
        }

        return response()->json($response);
    }

    public function search(Request $request){
        $services = $this->serviceService->searchBar(); //filters by slug attr(s)
        $total_products_count = Service::count();
        $searched_products_count = $services->count();
        $categories =$this->serviceCategory->getParentCategoryOnly();
        return view('frontend.service.search',compact('services','categories','total_products_count','searched_products_count'));
    }
}
