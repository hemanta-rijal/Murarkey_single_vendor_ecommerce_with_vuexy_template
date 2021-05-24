<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('admin.brands.index')->with('brands',$this->brandService->getAll());
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
        if ($request->hasFile('image'))
            $data['image'] = $request->image->store('public/brands');

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
    public function edit( $id)
    {
        return view('admin.brands.edit')->with('brand',$this->brandService->findById($id));
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
        if ($request->hasFile('image'))
            $data['image'] = $request->image->store('public/brands');
            
        // dd($this->brandService->update($id,$data));
        if($this->brandService->update($id,$data))
            return $this->redirectTo();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
