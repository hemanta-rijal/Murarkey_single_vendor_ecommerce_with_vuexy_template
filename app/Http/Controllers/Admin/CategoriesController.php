<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CategoriesExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductCategoryImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Categories\Contracts\CategoryService;
use Modules\Categories\Requests\CreateCategoryRequest;
use Modules\Categories\Requests\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
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

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    public function order()
    {
        $tree = $this->categoryService->getTree();

        return view('admin.categories.order', compact('tree'));
    }

    public function storeOrder(Request $request)
    {
        $this->categoryService->updateOrder($request->data);

        return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('icon_path')) {
            $data['icon_path'] = $request->icon_path->store('public/categories');
        }

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->image_path->store('public/categories');
        }

        $category = $this->categoryService->create($data);
        flash('Category added successfully', 'success');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryService->findById($id);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryService->findById($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('icon_path')) {
            $data['icon_path'] = $request->icon_path->store('public/categories');
        }

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->image_path->store('public/categories');
        }

        $this->categoryService->update($id, $data);
        flash('Successfully Updated!');

        return $this->redirectTo();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function uploadForm()
    {
        return view('admin.categories.upload-form');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("categories")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Categories Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Categories Could Not Be  Deleted."]);
        }
    }
    //importExport
    public function ImportExport()
    {
        return view('admin.categories.import-export');
    }

    public function Export()
    {
        return Excel::download(new CategoriesExport, 'categories.xlsx');

    }

    public function Import(Request $request)
    {
        ini_set('max_execution_time', 1200); //10 min

        try {
            Excel::import(new ProductCategoryImport($this->categoryService), request()->file('file'));
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
}
