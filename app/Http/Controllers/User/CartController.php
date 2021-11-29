<?php

namespace App\Http\Controllers\User;

use App\Http\ApiRequests\ApiCartRequest;
use App\Http\Controllers\Controller;
use Cart;
use Exception;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Gloudemans\Shoppingcart\Exceptions\UnknownModelException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Cart\Contracts\CartService;
use Modules\Cart\Services\WishlistService;
use Modules\Coupon\Services\CouponService;
use Modules\Products\Contracts\ProductService;

class CartController extends Controller
{
    private $cartService;
    private $productService;
    private $wishlistService;
    private $couponService;

    public function __construct(CartService $cartService,
                                ProductService $productService,
                                WishlistService $wishlistService,
                                CouponService $couponService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->wishlistService = $wishlistService;
        $this->couponService = $couponService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //check user has coupon or not
        $couponDetail=null;
        if($request->has('coupon')){
            $coupon= $this->couponService->getByCode($request->get('coupon'));
            if($coupon!=null){
                $couponDetail= $coupon->couponDetail;
//                dd($couponDetail);
            }
        }

        if (auth('web')->check()) {
            $cart = Cart::instance('default')->restore(auth('web')->user()->id);
            $items = Cart::content();
            $total = Cart::total();
            $tax = Cart::tax();
            $subTotal = Cart::subTotal();
            $shippingAmount = Cart::shippingAmount();
            Cart::store(auth('web')->user()->id);
            return view('frontend.user.view_cart', compact('items', 'total', 'subTotal', 'tax', 'shippingAmount'));
        } else {
            //TODO:: send login response with back request which is cart iteself
            return redirect()->route('login')->with('back_to', route('user.cart.index'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiCartRequest $request)
    {

        if ($request->ajax()) {
            try {
                DB::transaction(function () use ($request) {
                    checkProductStock($request->product_id);
                    $this->cartService->add(auth('web')->user(), $request->only('qty', 'options', 'product_id', 'type'));
                });
            } catch (UnknownModelException $exception) {
                return response()->json(['data' => '', 'message' => $exception->getMessage(), 'status' => 400, 'icon' => 'warning']);
            } catch (InvalidRowIDException $exception) {
                return response()->json(['data' => '', 'message' => $exception->getMessage(), 'status' => 400, 'icon' => 'warning']);
            } catch (\PDOException $exception) {
                return response()->json(['data' => '', 'message' => $exception->getMessage(), 'status' => 400, 'icon' => 'warning']);
            } catch (Exception $ex) {
                return response()->json(['data' => '', 'message' => $ex->getMessage(), 'status' => 400, 'icon' => 'warning']);
            }
            return response()->json(['data' => '', 'message' => 'Cart Inserted Successfully', 'status' => 200, 'icon' => 'success']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        foreach ($request->except(['_method', '_token']) as $rowId => $qty) {
            Cart::update($rowId, $qty);
        }

        Cart::store(auth('web')->user()->id);

        return redirect()->route('user.checkout.index');
    }
    public function updateCartContents(Request $request)
    {
        Cart::restore(auth('web')->user()->id);
        foreach ($request->row_ids as $rowId) {
            Cart::update($rowId, $request->qty[$rowId]);
        }
        Cart::store(auth('web')->user()->id);
        return redirect()->route('user.cart.index')->with('success', 'cart updated successfully');
        // return redirect()->back()->with('success', 'cart updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            try {
                $this->cartService->delete(auth('web')->user(), $id);
                return response()->json(['success' => 'Product Item Deleted From Cart List.'], 200);
            } catch (Exception $ex) {
                session()->flash('error', $ex->getMessage());
                return response()->json(['error' => $ex->getMessage()], 500);
            }
        }

        // $user = Auth::user();
        // $this->cartService->delete(auth()->user(), $id);
        // return redirect()->back();

    }

    public function getCartDropDown(Request $request)
    {
        if ($request->ajax()) {
            return view('frontend.partials.cart.addToCartHover');
        }
    }
    public function getCartCountData(Request $request)
    {
        if ($request->ajax()) {
            return countCartForUser();
        }
    }
}
