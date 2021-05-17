<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/4/18
 * Time: 8:43 AM
 */

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
        return $this->cartService->getCartByUser($this->auth->user());

    }

    public function store(ApiCartRequest $request)
    {
        return $this->cartService->add($this->auth->user(), $request->all());
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