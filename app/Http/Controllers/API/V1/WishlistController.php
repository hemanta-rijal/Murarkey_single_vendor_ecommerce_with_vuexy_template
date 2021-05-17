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
use App\Modules\Cart\Requests\WishlistExistsRequest;
use Modules\Cart\Services\WishlistService;


class WishlistController extends BaseController
{
    private $wishlistService;


    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        return $this->wishlistService->getCartByUser($this->auth->user());

    }

    public function store(ApiCartRequest $request)
    {
        $this->wishlistService->add($this->auth->user(), $request->all());
    }

    public function destroy($rowId)
    {
        $this->wishlistService->delete($this->auth->user(), $rowId);
    }

    public function update($rowId, ApiCartUpdateRequest $request)
    {
        $this->wishlistService->update($this->auth->user(), $rowId, $request->only('qty', 'options'));

    }

    public function productExists(WishlistExistsRequest $request)
    {
        $items = $this->wishlistService->getCartByUser($this->auth->user());

        return ['exists' => $items->filter(function ($item) use ($request) {
                return $item->id == $request->product_id;
            })->count() > 0];
    }

}