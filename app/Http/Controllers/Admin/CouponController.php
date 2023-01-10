<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Modules\Brand\Services\BrandService;
use Modules\Categories\Services\CategoryService;
use Modules\Coupon\Contracts\CouponService;
use Modules\Coupon\Requests\CreateCouponRequest;

class CouponController extends Controller
{

    private $couponService;
    private $brandService;
    private $categoryService;

    public function __construct(CouponService $couponService,BrandService $brandService,CategoryService $categoryService)
    {
        $this->couponService = $couponService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
    }

    private function RedirectTo()
    {
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->couponService->getPaginated();
        return view('admin.coupon.index', compact('coupons'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCouponRequest $request)
    {
        $data = $request->all();
        try {
            $this->couponService->create($data);
            flash('successfully added !!!')->success();
        } catch (\Throwable $th) {
            flash('could not add the details !!!')->error();
            flash($th->getMessage())->error();
            return redirect()->back();
        }
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = $this->couponService->findById($id);
        return view('admin.coupon.edit')->with('coupon', $coupon);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $this->couponService->update($id, $data);

        flash('Successfully Updated!');

        return $this->redirectTo();

    }

    /**
     * Remove the specifi
     * ed resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $coupon = $this->couponService->findById($id);
            if ($coupon) {
                $this->couponService->delete($coupon->id);
            }
            flash('data deleted successfully');
            return $this->redirectTo();
        } catch (\Throwable $th) {
            flash('data could not be deleted');
            flash($th->getMessage());
            return $this->redirectTo();
        }

    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        try {
            \DB::table("brands")->whereIn('id', explode(",", $ids))->delete();
            flash('successfully deleted');
            return response()->json(['success' => "Brands Deleted successfully."]);
        } catch (Exception $ex) {
            flash('could not be deleted');
            return response()->json(['error' => "Brands Could Not Be  Deleted."]);
        }
    }
    public function getAllBrands(){
        $allBrands = $this->brandService->getBrandWithProductCount();
        return view('admin.coupon.partials.selectBrands')->with('brands',$allBrands);
    }
}
