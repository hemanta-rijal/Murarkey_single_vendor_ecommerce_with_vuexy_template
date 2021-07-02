<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;
use Modules\Cart\Contracts\WishlistService;

class WishlistController extends Controller
{

    private $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $items = Cart::instance('wishlist')->content();
        $total = Cart::instance('wishlist')->total();
        $tax = Cart::instance('wishlist')->tax();
        $subTotal = Cart::instance('wishlist')->subTotal();

//        if (Cart::instance('wishlist')->count() == 0)
        //            return back();

        return view('user.cart.wishlist', compact('items', 'total', 'subTotal', 'tax'));
    }

    public function store(Request $request)
    {
        $this->wishlistService->add(auth('web')->user(), $request->only('qty', 'options', 'product_id'));
        if ($request->ajax()) {
            return response()->json(['message' => 'Product added to wishlist successfully.']);
        }
        session()->flash('success', 'Product added to wishlist successfully.');
        return redirect()->route('user.wishlist.index');
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
        $item = Cart::instance('wishlist')->get($id);

        Cart::instance('default')->customAdd($item);

        Cart::instance('default')->store(auth()->user()->id);

        Cart::instance('wishlist')->remove($id);

        Cart::instance('wishlist')->store(auth()->user()->id);

        session()->flash('product_moved', true);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        // return response()->json('message','hereis problem');
        // $this->wishlistService->delete(auth()->user(), $id);

        // return redirect('/');

        if ($request->ajax()) {
            try {
                $this->wishlistService->delete(auth()->user(), $id);
                return response()->json(['success' => 'Product Item Deleted From WishList List.'], 200);
            } catch (Exception $ex) {
                session()->flash('error', $ex->getMessage());
                return response()->json(['error' => $ex->getMessage()], 500);
            }

        }

    }
}
