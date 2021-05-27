<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Attribute\Requests\CreateAttributeRequest;
use Modules\Attribute\Contracts\AttributeServiceRepository;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $attributeService;

    public function __construct(AttributeServiceRepository $service)
    {
        $this->attributeService = $service;
    }

        public function redirectTo()
    {
        return redirect()->route('admin.attributes.index');
    }

    public function index()
    {
        // dd("here");
        $attributes = $this->attributeService->getPaginated();
        // dd($attributes);
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAttributeRequest $request)
    {
        $data = $request->all();
        try {
            $this->attributeService->create($data);
            flash('Successfully Added!!!')->success();
            return redirect()->route('admin.attributes.index')->with('message','Attributes Added Successfully');
        } catch (\Throwable $th) {
            $message="Could Not Be Added \n"+$th->getMessage();
            flash('danger',$message);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        // $attribute=$this->attributeService->findById($id);
        return view('admin.attributes.edit')->with(compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $data = $request->all();
        try {
            $this->attributeService->update($attribute->id,$data);
            flash('success','Successfully Updated!!!');
            return redirect()->route('admin.attributes.index');
        } catch (\Throwable $th) {
            $message="Could Not Be Updated \n"+$th->getMessage();
            flash('danger',$message);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("attributes")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted')->success();
            return response()->json(['success'=>"Atributes Deleted successfully."]);
        }catch(Exception $ex){
            flash('could not be deleted');
            return response()->json(['error'=>"Atributes Could Not Be  Deleted."]);
        }   
    }

}
