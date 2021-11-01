<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ServiceExport;
use App\Http\Controllers\Controller;
use App\Imports\ServiceImport;
use App\Models\Service;
use App\Models\ServiceHasServiceLabel;
use App\Models\ServiceLabel;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;
use Modules\Service\Contracts\ServiceService;
use Modules\Service\Requests\CreateServiceRequest;
use Modules\Service\Requests\UpdateServiceRequest;
use PDOException;

class ServiceController extends Controller
{
    protected $serviceService;
    protected $serviceCategoryService;

    public function __construct(ServiceService $service, ServiceCategoryService $CategoryService)
    {
        $this->serviceService = $service;
        $this->serviceCategoryService = $CategoryService;

    }
    public function redirectTo()
    {
        return redirect()->route('admin.services.index');
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
        // retrive 3rd level or last level categories only //have to manage 3 level of service categories for best execution(performance and all)
        // $service_categories = $this->serviceCategoryService->getAll();
        // $service_categories = $lastLevelCategories = $this->serviceCategoryService->getLastLevelCategories();
//        $service_categories = $this->serviceCategoryService->getThirdLevelCategories();
        $service_categories = $this->serviceCategoryService->getParentCategoryOnly();

        return view('admin.service.create')->with('service_categories', $service_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceRequest $request)
    {
        try {
            $data = $request->all();

            if ($request->hasFile('icon_image')) {
                $data['icon_image'] = $request->icon_image->store('public/services');
            }
            $this->serviceService->create($data);
            flash('service created successfully')->success();
            return redirect()->route('admin.services.index');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
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

        // retrive 3rd level or last level categories only //have to manage 3 level of service categories for best execution(performance and all)
        $service_categories = $this->serviceCategoryService->getAll();
        // $service_categories = $lastLevelCategories = $this->serviceCategoryService->getLastLevelCategories();
        // dd(generateNestedTree($service_categories));
        // dd(getServiceCategoriesForForm($service_categories));
        // $service_categories = getServiceCategoriesForForm($service_categories);
        // dd($service_categories);
        // dd(getThirdLevelServiceCategories($service_categories));
        $service_categories = $this->serviceCategoryService->getThirdLevelCategories();
        $service = $this->serviceService->findById($service);
        $selected_label = $service->labels()->pluck('label_id')->toArray();
        return view('admin.service.edit')->with(compact('service', 'service_categories', 'selected_label'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        // try {
        $data = $request->all();
        if ($request->hasFile('icon_image')) {
            $data['icon_image'] = $request->icon_image->store('public/service');
        }
        $this->serviceService->update($id, $data);
        flash('service created successfully')->success();
        return redirect()->route('admin.services.index');
        // } catch (\Throwable $th) {
        //     flash($th->getMessage())->error();
        //     return redirect()->route('admin.services.index');
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $service = $this->serviceService->findById($id);
            if ($service) {
                $this->serviceService->delete($service->id);
            }
            flash('data deleted successfully');
            return $this->redirectTo();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            flash('data could not be deleted');
            flash($th->getMessage());
            return $this->redirectTo();
        }

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
            $labelValue = [];
            if ($request->has('labels') && $request->has('service_id')) {
                foreach ($request->labels as $label) {
                    $serviceLabel = ServiceLabel::where('value', $label)->firstOrFail();
                    $serviceHasLabel = ServiceHasServiceLabel::where(['label_id' => $serviceLabel->id, 'service_id' => $request->service_id])->first();
                    $labelValue[$label] = $serviceHasLabel ? $serviceHasLabel->label_value : null;
                }
            }
            // dd($request->labels, $labelValue);
            return view('admin.service.service-lable-field')->with(['labels' => $request->labels, 'label_value' => $labelValue]);
        }
    }

    //import export
    public function ImportExport()
    {
        return view('admin.service.import-export');
    }
    public function Export()
    {
        return Excel::download(new ServiceExport, 'services.xlsx');

    }

    public function Import(Request $request)
    {
        ini_set('max_execution_time', 1200); //10 min

        try {
            Excel::import(new ServiceImport($this->serviceService, $this->serviceCategoryService), request()->file('file'));
            flash("successfully imported ")->success();
            return $this->redirectTo();
        } catch (Exception $ex) {
            dd($ex);
            flash($ex->getMessage())->error();
            flash("Could not imported ")->error();
            return $this->redirectTo();
        } catch (PDOException $pd) {
            dd($pd);
            flash($pd->getMessage())->error();
            flash("Could not imported ")->error();
            return $this->redirectTo();
        } catch (\Throwable $th) {
            dd($th);
            flash("Could not imported ")->error();
            flash($th->getMessage())->error();
            return $this->redirectTo();
        }

    }
    public function getChildren(Request $request){
      return $this->serviceCategoryService->getChildren($request->category_id);
    }

}
