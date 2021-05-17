<?php

namespace App\Http\Controllers\User;

use App\Http\ApiRequests\ApiCartRequest;
use App\Http\Controllers\Controller;
use Cart;
use Exception;
use Gloudemans\Shoppingcart\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Contracts\CartService;
use Modules\Cart\Services\WishlistService;
use Modules\Products\Contracts\ProductService;
use PhpParser\Node\Stmt\TryCatch;

class CartController extends Controller
{
    private $cartService;
    private $productService;
    private $wishlistService;

    public function __construct(CartService $cartService, ProductService $productService, WishlistService $wishlistService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->wishlistService = $wishlistService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Cart::content();
        // dd($items);
        $total = Cart::total();
        $tax = Cart::tax();
        $subTotal = Cart::subTotal();
        $shippingAmount = Cart::shippingAmount();
        // dd($shippingAmount);
        return view('user.cart.index', compact('items', 'total', 'subTotal', 'tax','shippingAmount'));
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
        //  if ($request->ajax()) {
            
        //  }
    //    return response()->json(['message' =>$request->all()]);
    //    return response()->json(['message' =>$request->only('qty', 'options', 'product_id')]);
        if ($request->has('add_to_cart')) {
            $this->cartService->add(auth()->user(), $request->only('qty', 'options', 'product_id'));
            if ($request->ajax()) {
                return response()->json(['message' =>'Product added to CartList successfully.']);
            }
            session()->flash('product_page_flash_message', 'Product added to cart successfully.');
        } elseif ($request->has('wishlist')) {
            $this->wishlistService->add(auth()->user(), $request->only('qty', 'options', 'product_id'));
            if ($request->ajax()) {
                return response()->json(['message' =>'Product added to wishlist successfully.']);
            }
            session()->flash('product_page_flash_message', 'Product added to wishlist successfully.');
           return redirect()->route('user.wishlist.index');
        } else {
            $product = $this->productService->findById($request->get('product_id'));
            $item = CartItem::fromBuyable($product, $request->get('options') ?? []);
            $item->setQuantity($request->get('qty'));
            $item->associate($product);
            session()->flash('buy_now', $item);
            return redirect()->route('user.checkout.index');
        }

        return back();

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

        Cart::store(auth()->user()->id);

        return redirect()->route('user.checkout.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        if($request->ajax()){
            try{
                $this->cartService->delete(auth()->user(), $id);
                return response()->json(['success'=>'Product Item Deleted From Cart List.'],200);
            }catch(Exception $ex){
                session()->flash('error', $ex->getMessage());
                return response()->json(['error'=> $ex->getMessage()],500);
            }
        //     if(){
        //         return response()->json(['success'=>'Product Item Deleted From Cart List.'],200);
        //     }
        // }else{
        //     session()->flash('error', 'Product added to wishlist successfully.');
        //     return response()->json(['error'=>'Product Item Could Not Be Deleted !!!'],500);
        }

        // $user = Auth::user();
        // $this->cartService->delete(auth()->user(), $id);
        // return redirect()->back();
        
    }
}
