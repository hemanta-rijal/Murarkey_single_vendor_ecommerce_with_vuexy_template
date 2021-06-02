<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Brand\Contracts\BrandServiceRepo;
use Modules\Products\Contracts\ProductService;
use Modules\Categories\Contracts\CategoryService;
use Modules\Products\Requests\CreateProductRequestByAdmin;
use Modules\Products\Requests\UpdateProductRequestByAdmin;

class ProductsController extends Controller
{
    private $productService,$brandService,$categoryService;

    /**
     * CompaniesController constructor.
     */
    public function __construct(ProductService $productService,BrandServiceRepo $brandService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = request()->type;

        $products = $this->productService->getPaginated($type);
        $counts = $this->productService->getProductCountByStatus();
        $products->load(['company', 'category', 'images', 'trade_infos']);


        $products->appends(['type' => $type]);

        return view('admin.products.index', compact('products', 'counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create')->with('brands',$this->brandService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequestByAdmin $request)
    {
        $data = $request->all();
     
        $this->productService->create($data);

        flash('Successfully Added!');

        return $this->redirectTo();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->findById($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productService->findById($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequestByAdmin $request, $id)
    {
        $data = $request->all();
        $this->productService->update($id, $data);

        return $this->redirectTo();

    }

    public function updateStatus($id, $status)
    {
        $this->productService->updateStatus($id, $status);
        flash('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->productService->delete($id, $request->force);
        flash('Successfully Deleted!');
        return $this->redirectTo();
    }

    public function recover(Request $request, $id)
    {
        $this->productService->recover($id);
        flash('Successfully Recover!');

        return back();
    }

    public function trash(Request $request)
    {
        $products = $this->productService->getTrashItems();

        return view('admin.products.trash', compact('products'));
    }

    public function ajaxSearchWithCategory(Request $request)
    {
        $categoryId = $request->category_id;
        $search = $request->search;

        $result = $this->productService->searchWithCategory($search, $categoryId)->unique('id');

        $products = [];
        foreach ($result as $item) {
            $products[] = $item;
        }

        return $products;
    }


    public function ajaxSearch()
    {
//        $search = $request->order_by = 'recently_added';

        $result = $this->productService->searchBar()['all_products'];

        $products = [];
        foreach ($result as $item) {
            $products[] = $item;
        }

        return $products;
    }

    public function redirectTo()
    {
        return redirect()->route('admin.products.index');
    }

    public function browseCategory($id){
        // dd($id);
        $children = $this->categoryService->getChildren($id);
        $opt = [];
        if($children){
            foreach($children as $child){
                $option =   '<option value="'.$child->id.'">'.$child->name.'</option>';
                array_push($opt,$option);
            }
        }else{
              $option =   '<option value="">No Child Category</option>';
                array_push($opt,$option);
        }
        return $opt;
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        
        try {
            \DB::table("products")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success'=>"Products Deleted successfully."]);
        }catch(Exception $ex){
            flash('could not be deleted');
            return response()->json(['error'=>"Products Could Not Be  Deleted."]);
        }   
    }
}
