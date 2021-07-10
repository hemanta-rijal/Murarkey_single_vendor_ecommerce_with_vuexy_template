<?php

namespace App\Http\Controllers;

use Modules\Admin\Contracts\PageService;
use Modules\Admin\Requests\ContactFormRequest;
use Modules\Service\Contracts\ServiceService;

class PageController extends Controller
{
    private $pageService;
    private $serviceService;

    public function __construct(PageService $pageService, ServiceService $serviceService)
    {
        $this->pageService = $pageService;
        $this->serviceService = $serviceService;
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
    public function serviceDetail($id)
    {
        $service = $this->serviceService->findById($id);
        if ($service) {
            return view('frontend.service.service-detail', compact('service'));
        }
        return 404;
    }

}
