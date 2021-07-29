<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $email = $request->subscriber_email;
        $this->newsletterService->addSubscriber($email);
        session()->flash('success', 'subscribed successfully');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("subscribers")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Subscribers Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Subscribers Could Not Be  Deleted."]);
        }
    }

}
