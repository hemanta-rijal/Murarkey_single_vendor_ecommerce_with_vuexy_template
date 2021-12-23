<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Attribute;
use App\Models\ProductHasAttribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Attribute\Services\AttributeService;
use Modules\Brand\Contracts\BrandServiceRepo;
use Modules\Categories\Contracts\CategoryService;
use Modules\Orders\Contracts\OrderService;
use Modules\Products\Contracts\ProductService;
use Modules\Products\Requests\CreateProductRequestByAdmin;
use Modules\Products\Requests\UpdateProductRequestByAdmin;
use PDOException;
use Throwable;

class ProductsController extends Controller
{
    private $productService, $brandService, $categoryService, $attributeService, $orderService;

    /**
     * CompaniesController constructor.
     */
    public function __construct(ProductService $productService, BrandServiceRepo $brandService, CategoryService $categoryService, AttributeService $attributeservice, OrderService $orderService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
        $this->attributeService = $attributeservice;
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

        return view('admin.products.index', compact('products', 'counts', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create')->with(['brands' => $this->brandService->getAll(), 'attributes' => $this->attributeService->getAll()]);
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
        $data['skin_tone']= $data['skin_tone']!=null ? implode(',',$data['skin_tone']):null;
        $data['skin_concern']= $data['skin_concern']!=null ? implode(',',$data['skin_concern']):null;
        $data['product_type']= $data['product_type']!=null ? implode(',',$data['product_type']):null;
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
        $keywords = array();
        foreach ($product->rel_keywords as $keyword) {
            array_push($keywords, $keyword->name);
        }
        $keywords = !empty($keywords) ? $keywords[0] : null;
        $selected_attributes = $product->attributes()? $product->attributes()->pluck('attribute_id')->toArray():null;
        return view('admin.products.edit', compact('product'))->with('brands', $this->brandService->getAll())->with(['keywords' => $keywords, 'selected_attributes' => $selected_attributes, 'all_attributes' => $this->attributeService->getAll()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        try {
            DB::transaction(function () use ($request, $id) {
                // $product = $this->productService->findById($id);
                // foreach ($product->order_item as $order_item) {
                //     $this->orderService->changeStatus($order_item->order_id, 'cancelled');
                // }
                $this->productService->delete($id, $request->force);
            });
            flash('Successfully Deleted!')->success();
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash('Could Not Be Deleted!')->error();
            flash($th->getMessage())->error();
            return $this->redirectTo();
        }
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

    public function browseCategory($id)
    {
        $children = $this->categoryService->getChildren($id);
        $opt = [];
        if ($children) {
            foreach ($children as $child) {
                $option = '<option value="' . $child->id . '">' . $child->name . '</option>';
                array_push($opt, $option);
            }
        } else {
            $option = '<option value="">No Child Category</option>';
            array_push($opt, $option);
        }
        return $opt;
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("products")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Products Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Products Could Not Be  Deleted."]);
        }
    }

    //import export
    public function ImportExport()
    {
        // dd("here");
        return view('admin.products.import-export');
    }
    public function Export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');

    }

    public function Import(Request $request)
    {
        ini_set('max_execution_time', 1200); //10 min

        try {
            Excel::import(new ProductsImport($this->productService, $this->categoryService, $this->brandService), request()->file('file'));
            flash("successfully imported ")->success();
            return $this->redirectTo();
        } catch (\Throwable $th) {
            dd($th);
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

    public function loadAttributeFields(Request $request)
    {
        if ($request->ajax()) {
            $attributeValues = [];

            if ($request->has('attrs') && $request->has('product_id')) {
                foreach ($request->attrs as $attr) {
                    $attribute = Attribute::where('value', $attr)->firstOrFail();
                    $productHasattribute = ProductHasAttribute::where(['attribute_id' => $attribute->id, 'product_id' => $request->product_id])->first();
                    $attributeValues[$attr] = $productHasattribute ? $productHasattribute->value : null;
                }
            }
            return view('admin.products.product-attribute-fields')->with(['attributes' => $request->attrs, 'attribute_values' => $attributeValues]);
        }

    }
    public function stockIndex()
    {
        $searchBy = request()->searchby;
        $products = $this->productService->getPaginated($search = $searchBy);
        $counts = $this->productService->getProductCountByStatus();
        $products->load(['company', 'category', 'images', 'trade_infos']);

        $products->appends(['fiterby' => $searchBy]);

        return view('admin.products.stock-manage.index', compact('products', 'counts', 'searchBy'));
    }
    public function filterBy(Request $request)
    {
        $searchBy = request()->searchby = $request->filter;
        return redirect()->route('admin.product.manage-stock.index', 'searchby=' . $searchBy);
    }

    public function stockBulkUpdate(Request $request)
    {
        //CODE
        foreach ($request->stock_units as $id => $stock) {
            $this->productService->updateStock($id, $stock);
        }
        flash('successully updated')->success();
        return redirect()->route('admin.product.manage-stock.index');
    }

}
