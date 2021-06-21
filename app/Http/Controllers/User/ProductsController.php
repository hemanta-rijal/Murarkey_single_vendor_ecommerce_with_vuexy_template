<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TempProduct;
use Illuminate\Http\Request;
use Modules\Products\Contracts\ProductService;
use Modules\Products\Requests\CreateProductRequest;
use Modules\Products\Requests\FileUploadRequest;
use Modules\Products\Requests\UpdateOutStockRequest;
use Modules\Products\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    private $productService;
    private $user;

    public function __construct(ProductService $service)
    {
        $this->productService = $service;

        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 10;
        $type = $request->type;
        $search = $request->search;
        $userId = $this->user->isAssociateSeller() ? $this->user->id : null;
        $products = $this->productService->getPaginated($type, $search, $perPage, $this->user->seller->company_id, $userId);
        $products->load(['trade_infos' => function ($query) {
            $query->orderBy('moq');
        }]);

        $count = $this->productService->getProductCountByStatus(null, auth()->user()->seller->company_id, $userId);

        $products->load('images');

        $products->appends(['per_page' => $perPage, 'search' => $search]);

        return view('user.products.index', compact('products', 'perPage', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        $product = $this->productService->create($data);
        flash('Product added successfully', 'success');

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
        $product = $this->productService->findByIdForSeller($id);

        return view('user.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productService->findByIdForSeller($id);

        return view('user.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->all();

        $this->productService->updateForSeller($id, $data);
        flash('Successfully Updated!');

        return $this->redirectTo();
    }

    public function imageUpload(FileUploadRequest $request, $name)
    {
        $path = $request->{$name}->store('public/products');

        return ['path' => $path, 'link' => resize_image_url($path, '50X50')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $userId = $this->user->isAssociateSeller() ? $this->user->id : null;
        $this->productService->delete($id, $request->force, $this->user->seller->company_id, $userId);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }

    public function emptyTrash()
    {
        $userId = $this->user->isAssociateSeller() ? $this->user->id : null;

        $this->productService->emptyTrash($this->user->seller->company_id, $userId);

        return redirect()->route('user.products.trash');
    }

    public function trash(Request $request)
    {
        $userId = $this->user->isAssociateSeller() ? $this->user->id : null;
        $perPage = $request->per_page ?? 10;

        $products = $this->productService->getTrashItems($this->user->seller->company_id, $userId);

        return view('user.products.trash', compact('products', 'perPage'));
    }

    public function recover(Request $request, $id)
    {
        $userId = $this->user->isAssociateSeller() ? $this->user->id : null;

        $this->productService->recover($id, $this->user->seller->company_id, $userId);

        return $this->redirectTo();
    }

    public function copy(Request $request, $id)
    {
        $userId = $this->user->isAssociateSeller() ? $this->user->id : null;

        $this->productService->copy($id, $this->user->seller->company_id, $userId);

        return $this->redirectTo();
    }

    public function deleteMultiple(Request $request)
    {
        $userId = $this->user->isAssociateSeller() ? $this->user->id : null;

        if ($request->get('id')) {
            foreach (explode(',', $request->get('id')) as $id) {
                $this->productService->delete($id, $request->force, $this->user->seller->company_id, $userId);
            }
        }

        return $this->redirectTo();
    }

    public function updateOutOfStock(UpdateOutStockRequest $request)
    {
        $userId = $this->user->isAssociateSeller() ? $this->user->id : null;

        $this->productService->updateOutOfStock($request->product_id, $request->out_of_stock, $this->user->seller->company_id, $userId);

        return back();
    }

    public function redirectTo()
    {
        return redirect()->route('user.products.index');
    }

    public function storingTempProduct(CreateProductRequest $request)
    {
        $data = $request->all();
        if (isset($data['temp_images'])) {
            foreach ($data['temp_images'] as $image) {
                $data['images'][] = $image;
            }
        }

        foreach (['attribute', 'moq', 'keyword'] as $item) {
            if (isset($data['old_' . $item])) {
                foreach ($data['old_' . $item] as $newItem) {
                    $data[$item][] = $item === 'keyword' ? $newItem['value'] : $newItem;
                }
            }
        }

        if (isset($data['id'])) {
            unset($data['id']);
        }

        $product = $this->productService->createTemp($data);
        return route('user.temp-product-preview', urlencode(encrypt($product->id)));
    }

    public function tempPreview($id)
    {
        $decryptedId = decrypt(urldecode($id));

        $product = TempProduct::findOrFail($decryptedId);

        return view('products.show', compact('product'));
    }
}
