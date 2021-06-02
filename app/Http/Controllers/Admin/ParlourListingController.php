<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ParlourListings\Services\ParlourListingService;
use Modules\ParlourListings\Requests\CreateParlourListingRequest;

class ParlourListingController extends Controller
{

    private $parlourService;

    public function __construct(ParlourListingService $parlourListing)
    {
        $this->parlourService = $parlourListing;
    }

    private function redirectTo(){
        return redirect()->route('admin.parlour-listing.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parlours = $this->parlourService->getAll();
        return view('admin.parlour.index')->with(compact('parlours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.parlour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateParlourListingRequest $request)
    {
        try {
            $data = $request->all();
            $this->parlourService->create($data,$request->feature_image);
            flash('successfully insterted !!!')->success();
           return $this->redirectTo();
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
            flash('could not insert !!!')->error();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParlourListing  $parlourListing
     * @return \Illuminate\Http\Response
     */
    public function show(ParlourListing $parlourListing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParlourListing  $parlourListing
     * @return \Illuminate\Http\Response
     */
    public function edit(ParlourListing $parlourListing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParlourListing  $parlourListing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParlourListing $parlourListing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParlourListing  $parlourListing
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParlourListing $parlourListing)
    {
        //
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("parlour-listings")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted')->success();
            return response()->json(['success'=>"Parlours Deleted successfully."]);
        }catch(Exception $ex){
            flash('could not be deleted')->error();
            return response()->json(['error'=>"Parlours Could Not Be  Deleted."]);
        }   
    }
}