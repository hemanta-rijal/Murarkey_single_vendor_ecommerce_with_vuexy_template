<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Modules\Admin\Contracts\PageService;
use Modules\Admin\Requests\ContactFormRequest;
use Modules\ServiceCategories\Services\ServiceCategoryService;
use Modules\Service\Contracts\ServiceService;
use phpDocumentor\Reflection\Types\Null_;

class PageController extends Controller
{
    private $pageService;
    private $serviceService;
    private $serviceCategoryService;

    public function __construct(PageService $pageService, ServiceService $serviceService, ServiceCategoryService $serviceCategoryService)
    {
        $this->pageService = $pageService;
        $this->serviceService = $serviceService;
        $this->serviceCategoryService = $serviceCategoryService;
    }

    public function getContactUsePage()
    {
        return view('frontend.contact-us');
    }

    public function show($slug)
    {
        return view('frontend.contact-us'); //since we do not have maintain about us page here so redirecting to contact-us page

        // $page = $this->pageService->findBySlug($slug);
        // // dd($page);
        // if (!$page->published) {
        //     abort(404);
        // }

        return view('pages.templates.' . $page->template, compact('page'));
    }

    public function postContactUsForm(ContactFormRequest $request)
    {
        $this->pageService->processContactForm($request->all());
        \session()->flash('contact_us_success_message', 'Your message has been recorded!');
        // flash('Mail successfully sent to the auther .Thank you for your message !')->success();
        return back();
    }

    // service detail page

    public function serviceCategoryDetail($slug)
    {
        $serviceCategory = $this->serviceCategoryService->findBySlug($slug);
        $serviceCategoryChild = $this->serviceCategoryService->getChildren($serviceCategory->id);
        if ($serviceCategoryChild->count() <= 0) {
            return redirect()->back()->with('danger', 'no child categories found');
        }
        $serviceCategorySibling=null;
        if($serviceCategory->parent_id!=null){
            $serviceCategorySibling = $this->serviceCategoryService->getSibling($serviceCategory->id);
        }
        return view('frontend.service.service-category-detail')->with(['serviceCategoryChild' => $serviceCategoryChild, 'serviceCategory' => $serviceCategory,'serviceCategorySibling'=>$serviceCategorySibling]);
    }

    public function serviceDetail($id)
    {
        $service = $this->serviceService->findById($id);
        $recommended = null;
        if ($service && $service->serviceCategory != null) {
            //sibling of service_Category's parent
            $serviceCategoryGrandParentSibling = $this->serviceCategoryService->getSibling($service->serviceCategory->parent_id);
            $serviceCategories = $this->serviceCategoryService->getSibling($service->category_id);
            return view('frontend.service.service_detail', compact('service', 'serviceCategories', 'serviceCategoryGrandParentSibling'));
        }
        return abort(404);
    }

    public function getAboutUs()
    {
        return abort(404);
    }

    public function serviceDetailOnClick(Request $request)
    {
        $service = $this->serviceService->findById($request->serviceId);
        if ($service) {
            return view('frontend.service.service_detail_partials', compact('service'));
        }

    }

    public function getPolicyPage($slug)
    {
        switch ($slug) {
            case 'support-policy':
                $policy = get_meta_by_key('support_policy');
                return view('frontend.pages.policy-page', compact('policy'));
                break;

            case 'privacy-policy':
                $policy = get_meta_by_key('privacy_policy');
                return view('frontend.pages.policy-page', compact('policy'));
                break;

            case 'return-policy':
                $policy = get_meta_by_key('return_policy');
                return view('frontend.pages.policy-page', compact('policy'));
                break;
            case 'terms-and-condition':
                $policy = get_meta_by_key('terms_and_condition');
                return view('frontend.pages.policy-page', compact('policy'));
                break;

            default:
                abort(404);
                break;
        }

    }

    public function autocompleteSearch(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $services = Service::orderby('title', 'asc')->select('id', 'title', 'price', 'slug')->limit(5)->get();
            $products = Product::orderby('name', 'asc')->select('id', 'name', 'price', 'slug')->limit(5)->get();
        } else {
            $services = Service::orderby('title', 'asc')->select('id', 'title', 'price', 'slug')->where('title', 'like', '%' . $search . '%')->limit(5)->get();
            $products = Product::orderby('name', 'asc')->select('id', 'name', 'price', 'slug')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }
        $productMap = $products->map(function ($product) {
            $url = URL::to('products/'. $product->slug);
            $image = $product->featured_image ? resize_image_url($product->featured_image, '50X50') : null;
            return array("id" => $product->id, "name" => $product->name, "url"=>$url, "value" => $product->name, "label" => "<a href='$url'><img src='$image'> <span> $product->name </span> <strong>Rs. $product->price</strong></a>");
        })->toArray();
        $serviceMap = $services->map(function ($service) {
            $url= URL::to('service-detail/' . $service->id);
            $image = $service->featured_image ? resize_image_url($service->featured_image,'50X50'): null;
            return array("id" => $service->id, "name" => $service->title, "url"=>$url, "value" => $service->title, "label" => "<a href='$url'><img src='$image'> <span>  $service->title </span> <strong>Rs. $service->price</strong></a>");
        })->toArray();

        //initialise $productAndService as null
        if(!empty($productMap) && empty($serviceMap)){
            $productAndService =$productMap;
        }elseif(empty($productMap) && !empty($serviceMap)){
            $productAndService =$serviceMap;
        }elseif(!empty($productMap) && !empty($serviceMap)){
            $mergeAndShuffleProductAndService = array_merge($productMap,$serviceMap);
            $productAndService = $mergeAndShuffleProductAndService;
        }else{
            $productAndService=[];
        }
        if (count($productAndService) > 0) {
            if(count($productAndService)>8){
                $productAndService = array_slice($productAndService,0,8);
            }

            return response()->json($productAndService);
        } else {
            $response[] = array("value" => '', 'label' => 'No Result Found');
        }
    }


}
