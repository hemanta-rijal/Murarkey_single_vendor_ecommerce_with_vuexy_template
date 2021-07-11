<?php

namespace App\Http\Controllers;

use Modules\Admin\Contracts\PageService;
use Modules\Admin\Requests\ContactFormRequest;
use Modules\Service\Contracts\ServiceService;
use Modules\ServiceCategories\Services\ServiceCategoryService;

class PageController extends Controller
{
    private $pageService;
    private $serviceService;
    private $serviceCategoryService;

    public function __construct(PageService $pageService, ServiceService $serviceService,ServiceCategoryService $serviceCategoryService)
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
        $page = $this->pageService->findBySlug($slug);

        if (!$page->published) {
            abort(404);
        }

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

    public function serviceCategoryDetail($slug){
        $serviceCategory = $this->serviceCategoryService->findBySlug($slug);
        $serviceCategoryChild = $this->serviceCategoryService->getChildren($serviceCategory->id);
        return view('frontend.service.service-category-detail')->with('serviceCategoryChild',$serviceCategoryChild);
    }

    public function serviceDetail($id)
    {
        $service = $this->serviceService->findById($id);
        if ($service) {
            $serviceCategories = $this->serviceCategoryService->getSibling($service->category_id);
            return view('frontend.service.service_detail', compact('service','serviceCategories'));
        }
        return 404;
    }

}
