<?php

namespace App\Http\Controllers;

use Modules\Admin\Contracts\PageService;
use Modules\Admin\Requests\ContactFormRequest;

class PageController extends Controller
{
    private $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
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
}
