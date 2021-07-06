<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Modules\Service\Contracts\ServiceService;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $service)
    {
        $this->serviceService = $service;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->serviceService->getAll();
        return view('admin.service.index')->with(compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            if ($request->hasFile('featured_image')) {
                $data['featured_image'] = $request->featured_image->store('public/services');
            }
            if ($request->hasFile('icon_image')) {
                $data['icon_image'] = $request->icon_image->store('public/services');
            }
            $this->serviceService->create($data);
            flash('service created successfully')->success();
            return redirect()->route('admin.services.index');
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
            return redirect()->route('admin.services.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($service)
    {
        $service = $this->serviceService->findById($service);
        return view('admin.service.edit')->with(compact('service'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('featured_image')) {
                $data['featured_image'] = $request->image->store('public/service');
            }
            if ($request->hasFile('icon_image')) {
                $data['icon_image'] = $request->image->store('public/service');
            }
            $this->serviceService->update($id, $data);
            flash('service created successfully')->success();
            return redirect()->route('admin.services.index');
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
            return redirect()->route('admin.services.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("services")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Service Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Service Could Not Be  Deleted."]);
        }
    }
}
