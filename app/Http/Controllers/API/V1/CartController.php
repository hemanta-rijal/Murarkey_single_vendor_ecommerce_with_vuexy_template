<?php

namespace App\Http\Controllers\API\V1;

use App\Http\ApiRequests\ApiCartRequest;
use App\Http\ApiRequests\ApiCartUpdateRequest;
use Modules\Cart\Contracts\CartService;

class CartController extends BaseController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return response()->json(['data' => $this->cartService->getCartByUser(auth()->user()), 'success' => true, 'message' => 'Item Added in cart', 'status' => 200]);
    }

    public function store(ApiCartRequest $request)
    {
        $this->cartService->add(auth()->user(), $request->all());
        return response()->json(['data' => '', 'success' => true, 'message' => 'Item Added in cart', 'status' => 200]);
    }

    public function destroy($rowId)
    {
        $this->cartService->delete(auth()->user(), $rowId);
        return response()->json(['data' => '', 'success' => true, 'message' => 'Item deleted cart successfully', 'status' => 200]);
    }

    public function update($rowId, ApiCartUpdateRequest $request)
    {

        $this->cartService->update(auth()->user(), $rowId, $request->only('qty', 'options'));
        return response()->json(['data' => '', 'success' => true, 'message' => 'Item updated cart successfully', 'status' => 200]);

    }

}
