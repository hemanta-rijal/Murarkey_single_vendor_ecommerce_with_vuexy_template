<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\FlashSales\Requests\CreateFlashSaleRequest;
use App\Modules\FlashSales\Requests\UpdateFlashSaleRequest;
use Modules\Admin\Requests\CreateFeaturedCompanyRequest;
use Modules\Admin\Requests\UpdateFeaturedCompanyRequest;
use Modules\FlashSales\Contracts\FlashSalesRepository;

class FlashSalesController extends Controller
{
    protected $flashSalesRepository;

    public function __construct(FlashSalesRepository $flashSalesRepository)
    {
        $this->flashSalesRepository = $flashSalesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flashSales = $this->flashSalesRepository->getPaginated();

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

//        dd($data);

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

        return view('admin.flash-sales.edit', compact('flashSale'));
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
