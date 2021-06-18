<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\JoinMurarkey\Contracts\JoinMurarkeyService;

class JoinMurarkeyController extends Controller
{
    protected $joinMurarkeyService;
    public function __construct(JoinMurarkeyService $joinMurarkey)
    {
        $this->joinMurarkeyService = $joinMurarkey;
    }

    public function parlourProfession()
    {
        return view('frontend.parlour.parlour-profession');
    }
    public function joinParlourProfessionForm()
    {
        return view('frontend.parlour.join-profession-form');
    }
    public function storeParlourProfession(Request $request)
    {
        $data = $request->all();
        $data['preferred_work'] = json_encode($request->preferred_work);
        $data['preferred_location'] = json_encode($request->preferred_location);
        if ($this->joinMurarkeyService->create($data)) {
            // flash("Data successfully stored !!")->success();
            return redirect()->route('home')->with('success_message', 'Data successfully stored stored !!!');
        } else {
            flash("Could not be stored !!!")->error();
            return redirect()->back();
        }
    }

}
