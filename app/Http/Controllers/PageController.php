<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Admin\Contracts\PageService;
use Modules\Admin\Requests\ContactFormRequest;
use Modules\ServiceCategories\Services\ServiceCategoryService;
use Modules\Service\Contracts\ServiceService;

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
        // dd("here");
        $page = $this->pageService->findBySlug($slug);
        // dd($page);
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

    public function serviceCategoryDetail($slug)
    {
        $serviceCategory = $this->serviceCategoryService->findBySlug($slug);
        $serviceCategoryChild = $this->serviceCategoryService->getChildren($serviceCategory->id);
        if ($serviceCategoryChild->count() <= 0) {
            return redirect()->back()->with('danger', 'no child categories found');
        }
        return view('frontend.service.service-category-detail')->with(['serviceCategoryChild' => $serviceCategoryChild, 'serviceCategory' => $serviceCategory]);
        // return $this->serviceDetail($serviceCategoryChild->first()->services->first()->id);
        // or
        // return redirect()->route('service.detail', $serviceCategoryChild->first()->services->first()->id);
    }

    public function serviceDetail($id)
    {
        $service = $this->serviceService->findById($id);
        $recommended = null;
        // dd($service->serviceCategory);
        if ($service && $service->serviceCategory != null) {
            if ($service->serviceCategory->child_category->count() > 2) {
                $recommended = $service->serviceCategory->child_category->random(2);
            }
            $serviceCategories = $this->serviceCategoryService->getSibling($service->category_id);
            return view('frontend.service.service_detail', compact('service', 'serviceCategories', 'recommended'));
        }
        return abort(404);
    }
    public function getAboutUs()
    {
        // return view('');
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
                $policy = get_meta_by_key('support-policy');
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
            case 'terms_and_condition':
                $policy = get_meta_by_key('terms_and_condition');
                return view('frontend.pages.policy-page', compact('policy'));
                break;

            default:
                abort(404);
                break;
        }

    }

}
