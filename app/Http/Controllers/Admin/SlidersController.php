<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Contracts\SliderService;
use Modules\Admin\Requests\CreateSliderRequest;
use Modules\Admin\Requests\UpdateSliderRequest;

class SlidersController extends Controller
{
    private $sliderService;

    public function __construct(SliderService $service)
    {
        $this->sliderService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = $this->sliderService->getPaginated();

        return view('admin.sliders.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSliderRequest $request)
    {
        $data = $request->all();

        $slide = $this->sliderService->create($data, $request->image);

        flash('Slider added successfully', 'success');
        
        return $this->redirectTo();
    }

    public function redirectTo()
    {
        return redirect()->route('admin.sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = $this->sliderService->findById($id);

        return view('admin.sliders.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = $this->sliderService->findById($id);

        return view('admin.sliders.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, $id)
    {
        $data = $request->all();

        $this->sliderService->update($id, $data, $request->image);

        flash('Successfully updated!');

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
        $message = "Can't delete this account";
        if(auth()->id() != $id) {

            $this->sliderService->delete($id);
            $message = 'Successfully deleted!';
        }

        flash($message);
        return $this->redirectTo();
    }
}
