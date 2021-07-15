<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Modules\Testimonial\Contracts\TestimonialService;
use Modules\Testimonial\Requests\CreateTestimonialRequest;
use Modules\Testimonial\Requests\UpdateTestimonialRequest;

class TestimonialController extends Controller
{

    protected $testimonialService;

    public function __construct(TestimonialService $testimonial)
    {
        $this->testimonialService = $testimonial;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = $this->testimonialService->getPaginated();
        return view('admin.testimonial.index')->with(compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->image->store('public/testimonials');
            }
            $this->testimonialService->create($data);
            flash('testimonial created successfully')->success();
            return redirect()->route('admin.testimonials.index');
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($testimonial)
    {
        $testimonial = $this->testimonialService->findById($testimonial);
        return view('admin.testimonial.edit')->with(compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonialRequest $request, $id)
    {
        try {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->image->store('public/testimonials');
            }
            flash('testimonial updated successfully')->success();
            $this->testimonialService->update($id, $data);
            return redirect()->route('admin.testimonials.index');
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
            return redirect()->route('admin.testimonials.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("testimonials")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Testimonial Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Testimonial Could Not Be  Deleted."]);
        }
    }
}
