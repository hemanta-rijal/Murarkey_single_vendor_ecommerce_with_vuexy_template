<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\JoinMurarkey;
use Illuminate\Http\Request;
use Modules\JoinMurarkey\Contracts\JoinMurarkeyService;

class JoinMurarkeyController extends Controller
{
    protected $joinMurarkeyService;
    public function __construct(JoinMurarkeyService $joinMurarkey)
    {
        $this->joinMurarkeyService = $joinMurarkey;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = $this->joinMurarkeyService->getPaginated();
        return view('admin.murarkey-pro-subscribers.subscribers')->with('subscribers', $subscribers);
    }

    public function show($id)
    {
        $subscriber = $this->joinMurarkeyService->findById($id);
        if ($subscriber) {
            $preferred_locations = json_decode($subscriber->preferred_location);
            $preferred_works = json_decode($subscriber->preferred_work);
            return view('admin.murarkey-pro-subscribers.show')
                ->with([
                    'subscriber' => $subscriber,
                    'preferred_locations' => $preferred_locations,
                    'preferred_works' => $preferred_works,
                ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JoinMurarkey  $joinMurarkey
     * @return \Illuminate\Http\Response
     */
    public function edit(JoinMurarkey $joinMurarkey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JoinMurarkey  $joinMurarkey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JoinMurarkey $joinMurarkey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JoinMurarkey  $joinMurarkey
     * @return \Illuminate\Http\Response
     */
    public function destroy(JoinMurarkey $joinMurarkey)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        try {
            \DB::table("join_murarkeys")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Subscriber Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Subscriber Could Not Be  Deleted."]);
        }
    }

    public function mailAll(Request $request)
    {

        $data = $request->all();

        $rtrrimmed = rtrim($request->to, ", ");
        $emails = explode(',', $rtrrimmed);

        $names = null;
        foreach ($emails as $email) {
            $user = JoinMurarkey::where('email', $email)->firstOrFail();
            $names .= $user->full_name . ',';
        }
        $rtrrimmed = rtrim($names, ", ");
        $names = explode(',', $rtrrimmed);

        $data['names'] = $names;
        $data['emails'] = $emails;

        try {
            $job = (new SendEmailJob($data))->delay(now()->addSeconds(5));
            dispatch($job);
            flash('Mail Sent To The User/Subscriber(s)')->success();
        } catch (\Throwable $th) {
            flash('Mail Could Not Sent To The User/Subscriber(s)')->error();
            flash($th->getMessage())->error();
        }
        return redirect()->back();
        // return redirect()->route('admin.join-murarkey.index');
    }

    public function mailAllProSubscribers(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $emails = null;

            foreach ($request->ids as $id) {
                $user = JoinMurarkey::find($id);
                $data[$user->full_name] = $user->email;
                $emails .= $user->email . ',';
            }
            $route = 'admin.pro-subscribers.mail-all';
            return view('admin.partials.compose-mails-modal')->with(['data' => $data, 'emails' => $emails, 'route' => $route]);
        }
    }

}
