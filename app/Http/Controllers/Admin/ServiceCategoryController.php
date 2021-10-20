<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\ServiceCategories\Contracts\ServiceCategoryService;

class ServiceCategoryController extends Controller
{

    private $categoryService;

    public function __construct(ServiceCategoryService $service)
    {
        $this->categoryService = $service;
    }

    public function redirectTo()
    {
        return redirect()->route('admin.service-categories.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->getPaginated();
        $categories->load('parent');
        return view('admin.service-categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service-categories.create');
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
            if ($request->hasFile('banner_image')) {
                $data['banner_image'] = $request->banner_image->store('public/service-categories');
            }
            if ($request->hasFile('icon_image')) {
                $data['icon_image'] = $request->icon_image->store('public/service-categories');
            }
            $category = $this->categoryService->create($data);
            flash('Category added successfully', 'success');
            return $this->redirectTo();

        } catch (\Throwable $th) {
            // dd($th->getMessage());
            flash($th->getMessage())->error();
            return $this->redirectTo();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryService->findById($id);

        return view('admin.service-categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('banner_image')) {
                $data['banner_image'] = $request->banner_image->store('public/service-categories');
            }
            if ($request->hasFile('icon_image')) {
                $data['icon_image'] = $request->icon_image->store('public/service-categories');
            }
            $category = $this->categoryService->update($id, $data);
            flash('Category updated successfully', 'success');
            return $this->redirectTo();

        } catch (\Throwable $th) {
            flash($th->getMessage(), 'error');
            return $this->redirectTo();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $this->categoryService->delete($id);
            });
            flash('Successfully deleted!');
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash($th->getMessage(), 'error');
            return $this->redirectTo();

        }

    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("service_categories")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Categories Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Categories Could Not Be  Deleted."]);
        }
    }
}
