<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\FlashSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Products\Contracts\ProductService;
use Modules\FlashSales\Contracts\FlashSalesRepository;
use App\Modules\FlashSales\Requests\CreateFlashSaleRequest;
use App\Modules\FlashSales\Requests\UpdateFlashSaleRequest;

class FlashSalesController extends Controller
{
    protected $flashSalesRepository,$productService;

    public function __construct(FlashSalesRepository $flashSalesRepository,ProductService $productService)
    {
        $this->flashSalesRepository = $flashSalesRepository;
        $this->productService = $productService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $flashSales = $this->flashSalesRepository->getPaginated();
        $flashSales = $this->flashSalesRepository->getAll();

        return view('admin.flash-sales.index', compact('flashSales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.flash-sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFlashSaleRequest $request)
    {
        $data = $request->all();

        $flashSale = $this->flashSalesRepository->create($data);

        flash('Flash sales added successfully', 'success');

        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.flash-sales.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flashSale = $this->flashSalesRepository->findById($id);
        $products = $this->productService->searchBar()['all_products'];
        return view('admin.flash-sales.edit', compact('flashSale'))->with('products',$products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFlashSaleRequest $request, $id)
    {
        $data = $request->all();
        if (!isset($data['published']))
        $data['published'] = false;
        
        $this->flashSalesRepository->update($id, $data);

        flash('Successfully Updated!');

        return $this->redirectTo();
    }

    public function updateOrder(Request $request){
        try {
           $orders = array_filter($request->order,'strlen');
            foreach($orders as $flashID=>$order){
                FlashSale::find($flashID)->update(['weight' => $order]);
                // $this->flashSalesRepository->update($saleId,['weight'=>$order]);
            }
            return response()->json(['success'=>"Flash Sale Update Successfully."]);

       } catch (\Throwable $th) {
           $message ="Flash Sale Order Not Updated.\n".$th->getMessage();
            return response()->json(['error'=>$message]);
       }
           

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->flashSalesRepository->delete($id);
        flash('Successfully deleted!');

        return $this->redirectTo();
    }
}
