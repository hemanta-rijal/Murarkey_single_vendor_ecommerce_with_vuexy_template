<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ParlourListingExport;
use App\Http\Controllers\Controller;
use App\Imports\ParlourListingImport;
use App\Models\ParlourListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ParlourListings\Requests\CreateParlourListingRequest;
use Modules\ParlourListings\Services\ParlourListingService;
use Modules\Service\Services\ServiceService;
use PDOException;
use Throwable;

class ParlourListingController extends Controller
{

    private $parlourService;
    private $serviceService;

    public function __construct(ParlourListingService $parlourListing,ServiceService $serviceService)
    {
        $this->parlourService = $parlourListing;
        $this->serviceService = $serviceService;
    }

    private function redirectTo()
    {
        return redirect()->route('admin.parlour-listing.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parlours = $this->parlourService->getPaginated();
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
            $this->parlourService->create($data, $request->feature_image);
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
        $parlorServices = $this->serviceService->getParlourService();
        return view('admin.parlour.show')->with(compact('parlourListing','parlorServices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParlourListing  $parlourListing
     * @return \Illuminate\Http\Response
     */
    public function edit(ParlourListing $parlourListing)
    {
        return view('admin.parlour.edit')->with('parlour', $parlourListing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParlourListing  $parlourListing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $this->parlourService->update($id, $data, $request->feature_image);
            flash('successfully updated !!!')->success();
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
            flash('could not update !!!')->error();
            return redirect()->back();
        }
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
            \DB::table("parlour_listings")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted')->success();
            return response()->json(['success' => "Parlours Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted')->error();
            return response()->json(['error' => "Parlours Could Not Be  Deleted."]);
        }
    }

    //import export
    public function ImportExport()
    {
        return view('admin.parlour.import-export');
    }
    public function Export()
    {
        return Excel::download(new ParlourListingExport, 'parlourListings.xlsx');

    }

    public function Import(Request $request)
    {
        ini_set('max_execution_time', 1200); //10 min

        try {
            Excel::import(new ParlourListingImport, request()->file('file'));
            flash("successfully imported ")->success();
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash("Could not imported ")->error();
            flash($th->getMessage())->error();
            return $this->redirectTo();
        } catch (Exception $ex) {
            flash($ex->getMessage())->error();
            flash("Could not imported ")->error();
            return $this->redirectTo();
        } catch (PDOException $pd) {
            flash($pd->getMessage())->error();
            flash("Could not imported ")->error();
            return $this->redirectTo();
        }
    }
    public function assignService(Request $request,$parlor_id){
        $parlor = $this->parlourService->findById($parlor_id);
        if($parlor){
            $parlor->services()->sync(array_values(array_slice($request->services,0,2)));
            flash('Services assign to Parlours');
            return redirect()->back();
        }
    }

}
