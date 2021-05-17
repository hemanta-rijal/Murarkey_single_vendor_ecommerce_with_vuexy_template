<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Modules\Newsletter\Contracts\NewsletterService;

class NewsletterController extends Controller
{
    private $newsletterService;

    public function __construct(NewsletterService $service)
    {
        $this->newsletterService = $service;
    }

    public function subscribers()
    {
        $subscribers = $this->newsletterService->getSubscribers();

        return view('admin.newsletter.subscribers', compact('subscribers'));
    }

    public function deleteSubscriber($id)
    {
        NewsletterSubscriber::destroy($id);
        flash('Subscriber deleted successfully', 'success');

        return back();
    }

}
