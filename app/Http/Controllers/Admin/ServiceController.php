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

    public function index()
    {
        $services = $this->serviceService->getPaginated();
        return view('admin.service.index')->with(compact('services'));
    }

    public function create()
    {
        $service_categories = $this->serviceCategoryService->getParentCategoryOnly();
        return view('admin.service.create')->with('service_categories', $service_categories);
    }

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

    public function show(Service $service)
    {

    }

    public function edit($service)
    {
        // retrive 3rd level or last level categories only //have to manage 3 level of service categories for best execution(performance and all)
        $service_categories = $this->serviceCategoryService->getParentCategoryOnly();
        $service = $this->serviceService->findById($service);
        $selected_label = $service->labels()->pluck('label_id')->toArray();
        return view('admin.service.edit')->with(compact('service', 'service_categories', 'selected_label'));

    }

    public function update(UpdateServiceRequest $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('icon_image')) {
            $data['icon_image'] = $request->icon_image->store('public/service');
        }
        $this->serviceService->update($id, $data);
        flash('service created successfully')->success();
        return redirect()->route('admin.services.index');
    }

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
        //        try {
        Excel::import(new ServiceImport($this->serviceService, $this->serviceCategoryService), request()->file('file'));
        flash("successfully imported ")->success();
        return $this->redirectTo();
    }
    public function getChildren(Request $request)
    {
        return $this->serviceCategoryService->getChildren($request->category_id);
    }

    public function getImages($id)
    {
        $services = $this->serviceService->findById($id);
        return view('admin.service.image-viewer')->with('service', $services);
    }

    public function deleteImage(Request $request)
    {
        $service = $this->serviceService->deleteProductImage($request->image);
        if ($service) {
            return response()->json(['data' => '', 'message' => 'image deleted successfully', 'status' => true]);
        }
        return response()->json(['data' => '', 'message' => 'image cannot deleted', 'status' => false]);
    }

    public function addImage(Request $request)
    {
        $data = $request->all();
        $service = $this->serviceService->findById($data['product_id']);
        if ($this->serviceService->addImages($data,$service))
            return redirect()->back();
        return redirect()->back()->with('error','Image couldn\'t be Inserted Successfully');
    }

}
