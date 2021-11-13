<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BrandsExport;
use App\Http\Controllers\Controller;
use App\Imports\BrandImport;
use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Brand\Contracts\BrandServiceRepo;
use Modules\Brand\Requests\CreateBrandRequest;
use Modules\Brand\Requests\UpdateBrandRequest;

class BrandController extends Controller
{

    private $brandService;

    public function __construct(BrandServiceRepo $service)
    {
        $this->brandService = $service;
    }

    public function redirectTo()
    {
        return redirect()->route('admin.brands.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brands.index')->with('brands', $this->brandService->getPaginated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('public/brands');
        }

        $this->brandService->create($data);
        flash('Brand Detail Added Successfully!');

        return $this->redirectTo();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.brands.edit')->with('brand', $this->brandService->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('public/brands');
        }

        // dd($this->brandService->update($id,$data));
        if ($this->brandService->update($id, $data)) {
            return $this->redirectTo();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $coupon = $this->brandService->findById($id);
            if ($coupon) {
                $this->brandService->delete($coupon->id);
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
            \DB::table("brands")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Brands Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Brands Could Not Be  Deleted."]);
        }
    }

    public function ImportExport()
    {
        return view('admin.brands.import-export');
    }
    public function Export()
    {
        return Excel::download(new BrandsExport, 'brands.xlsx');

    }
    public function Import()
    {
        ini_set('max_execution_time', 1200); //10 min

        try {
            Excel::import(new BrandImport($this->brandService), request()->file('file'));
            flash("successfully imported ")->success();
            return $this->redirectTo();
        } catch (Exception $ex) {
            dd($ex);
            flash($ex->getMessage())->error();
            flash("Could not imported ")->error();
            return $this->redirectTo();
        } catch (PDOException $pd) {
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
}
