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
        return response()->json(['data'=>$this->cartService->getCartByUser($this->auth->user())]);

    }

    public function store(ApiCartRequest $request)
    {
        $this->cartService->add(auth()->user(), $request->all());
        return  response()->json(['data'=>'','success'=>true,'message'=>'Item Added in cart','status'=>200]);
    }

    public function destroy($rowId)
    {
        return $this->cartService->delete($this->auth->user(), $rowId);
    }

    public function update($rowId, ApiCartUpdateRequest $request)
    {
        return $this->cartService->update($this->auth->user(), $rowId, $request->only('qty', 'options'));

    }

}