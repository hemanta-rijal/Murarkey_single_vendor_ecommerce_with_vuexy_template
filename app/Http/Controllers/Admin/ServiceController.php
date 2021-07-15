<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;
use Modules\Service\Contracts\ServiceService;

class ServiceController extends Controller
{
    protected $serviceService;
    protected $serviceCategoryService;

    public function __construct(ServiceService $service, ServiceCategoryService $CategoryService)
    {
        $this->serviceService = $service;
        $this->serviceCategoryService = $CategoryService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->serviceService->getPaginated();
        return view('admin.service.index')->with(compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service_categories = $this->serviceCategoryService->getAll();
        return view('admin.service.create')->with('service_categories', $service_categories);
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
        $service_categories = $this->serviceCategoryService->getAll();

        $service = $this->serviceService->findById($service);
        // dd($service->labels->service_label);
        return view('admin.service.edit')->with(compact('service', 'service_categories'));

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

    public function getServiceLabelField(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.service.service-lable-field')->with('labels', $request->labels);
        }
    }
}
