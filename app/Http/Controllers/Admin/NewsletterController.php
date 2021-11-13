<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Modules\Newsletter\Contracts\NewsletterService;

class NewsletterController extends Controller
{
    private $newsletterService;

    public function __construct(NewsletterService $service)
    {
        $this->newsletterService = $service;
    }

    public function redirectTo()
    {
        return redirect()->route('admin.newsletter.subscribers');
    }

    public function subscribers()
    {
        $subscribers = $this->newsletterService->getSubscribers();

        return view('admin.newsletter.subscribers', compact('subscribers'));
    }

    public function destroy($id)
    {
        try {
            $subscriber = $this->newsletterService->findById($id);
            if ($service) {
                $this->newsletterService->delete($subscriber->delete());
            }
            flash('data deleted successfully');
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash('data could not be deleted');
            flash($th->getMessage());
            return $this->redirectTo();
        }
    }
    public function deleteSubscriber($id)
    {
        try {
            $subscriber = $this->newsletterService->findById($id);
            if ($subscriber) {
                $this->newsletterService->delete($subscriber->id);
            }
            flash('data deleted successfully');
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash('data could not be deleted');
            flash($th->getMessage());
            return $this->redirectTo();
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
            $route = 'admin.newsletter.mail-all';
            return view('admin.partials.compose-mails-modal')->with(['data' => $data, 'emails' => $emails, 'route' => $route]);
        }
    }

}
