<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Newsletter\Contracts\NewsletterService;
use Modules\Newsletter\Requests\CreateNewsletterSubscriberRequest;

class NewsletterController extends Controller
{
    private $newsletterService;

    /**
     * NewsletterController constructor.
     */
    public function __construct(NewsletterService $service)
    {
        $this->newsletterService = $service;
    }
// CreateNewsletterSubscriberRequest
    public function addSubscriber(CreateNewsletterSubscriberRequest $request)
    {
        // dd($request);
        $email = $request->subscriber_email;
        $this->newsletterService->addSubscriber($email);
        session()->flash('news_letter_subscriber_added', true);
        return back();
    }
}
