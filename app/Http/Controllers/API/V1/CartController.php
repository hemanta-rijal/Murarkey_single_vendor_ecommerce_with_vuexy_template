<?php

namespace App\Http\Controllers\API\V1;

use App\Http\ApiRequests\ApiCartRequest;
use App\Http\ApiRequests\ApiCartUpdateRequest;
use Modules\Cart\Contracts\CartService;
use Modules\Users\Services\UserService;

class CartController extends BaseController
{
    private $cartService;
    private $userService;

    public function __construct(CartService $cartService,UserService $userService)
    {
        $this->cartService = $cartService;
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json(['data' => $this->cartService->getCartByUser($this->userService->getLogedInUser()), 'success' => true, 'message' => 'Item Added in cart', 'status' => 200]);
    }

    public function store(ApiCartRequest $request)
    {
        $this->cartService->add($this->userService->getLogedInUser(), $request->all());
        return response()->json(['data' => '', 'success' => true, 'message' => 'Item Added in cart', 'status' => 200]);
    }

    public function destroy(Request $request, $rowId)
    {
        $this->cartService->delete($this->userService->getLogedInUser(), $rowId);
        return response()->json(['data' => '', 'success' => true, 'message' => 'Item deleted cart successfully', 'status' => 200]);
    }

    public function update($rowId, ApiCartUpdateRequest $request)
    {
        $this->cartService->update($this->userService->getLogedInUser(), $rowId, $request->only('qty', 'options'));
        return response()->json(['data' => '', 'success' => true, 'message' => 'Item updated cart successfully', 'status' => 200]);
    }

}
