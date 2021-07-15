<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\ServiceLabel\Services\ServiceLabelService;

class ServiceLabelController extends Controller
{

    protected $serviceLabelService;

    public function __construct(ServiceLabelService $serviceLabel)
    {
        $this->serviceLabelService = $serviceLabel;

    }

    public function redirectTo()
    {
        return redirect()->route('admin.service-labels.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceLabels = $this->serviceLabelService->getPaginated();
        return view('admin.service-labels.index')->with(compact('serviceLabels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service-labels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['value'] = Str::slug($request->name);
            $this->serviceLabelService->create($data);
            flash('succssfully inserted')->success();
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
            return $this->redirectTo();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceLabel  $serviceLabel
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceLabel $serviceLabel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceLabel  $serviceLabel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceLabel = $this->serviceLabelService->findById($id);
        return view('admin.service-labels.edit')->with(compact('serviceLabel'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceLabel  $serviceLabel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $data['value'] = Str::slug($request->name);
            $this->serviceLabelService->update($id, $data);
            flash('succssfully updated')->success();
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
            return $this->redirectTo();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceLabel  $serviceLabel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceLabel $serviceLabel)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("service_labels")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted')->success();
            return response()->json(['success' => "Service Labels Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted')->error();
            return response()->json(['error' => "Service Labels Could Not Be  Deleted."]);
        }
    }

}
