<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
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

    public function mailAll(Request $request)
    {
        $data = $request->all();

        $rtrrimmed = rtrim($request->to, ", ");
        $emails = explode(',', $rtrrimmed);

        $names = null;
        foreach ($emails as $email) {
            $user = NewsletterSubscriber::where('email', $email)->firstOrFail();
            $names .= $user->name . ',';
        }
        $rtrrimmed = rtrim($names, ", ");
        $names = explode(',', $rtrrimmed);

        $data['names'] = $names;
        $data['emails'] = $emails;
        try {
            $job = (new SendEmailJob($data))->delay(now()->addSeconds(5));
            dispatch($job);
            flash('Mail Sent To The User(s)')->success();
        } catch (\Throwable $th) {
            flash('Mail Could Not Sent To The User(s)')->error();
            flash($th->getMessage())->error();
        }
        return redirect()->back();
    }

    public function mailAllUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $emails = null;

            foreach ($request->ids as $id) {
                $user = NewsletterSubscriber::findOrFail($id);
                $data[$user->name] = $user->email;
                $emails .= $user->email . ',';
            }
            $route = 'admin.users.mail-all';
            return view('admin.partials.compose-mails-modal')->with(['data' => $data, 'emails' => $emails, 'route' => $route]);
        }
    }
}
