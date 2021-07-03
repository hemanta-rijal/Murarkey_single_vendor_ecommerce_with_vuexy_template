<?php

namespace App\Http\Controllers\API\V1;

use App\Http\ApiRequests\ApiCartRequest;
use App\Http\ApiRequests\ApiCartUpdateRequest;
use Modules\Cart\Services\WishlistService;

class WishlistController extends BaseController
{
    private $wishlistService;
    private $auth;
    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
        $this->auth = auth();
    }

    public function index()
    {
        $data = $this->wishlistService->getWishlistByUser($this->auth->user());

        return response()->json(['data' => $data, 'success' => true, 'message' => 'Items fetched from wishlist', 'status' => 200]);

    }

    public function store(ApiCartRequest $request)
    {
        $items = $this->wishlistService->getWishlistByUser($this->auth->user());

        if ($items->filter(function ($item) use ($request) {
            return $item->id == $request->product_id;
        })->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Item already exists in wishlist', 'status' => 500]);
        }
        $this->wishlistService->add($this->auth->user(), $request->all());
        return response()->json(['success' => true, 'message' => 'Item added in wishlist', 'status' => 200]);

    }

    public function destroy($rowId)
    {
        $this->wishlistService->delete($this->auth->user(), $rowId);
        return response()->json(['success' => true, 'message' => 'Item removed from wishlist', 'status' => 200]);

    }

    public function update($rowId, ApiCartUpdateRequest $request)
    {
        $this->wishlistService->update($this->auth->user(), $rowId, $request->only('qty', 'options'));
        return response()->json(['success' => true, 'message' => 'Item updated on wishlist', 'status' => 200]);

    }

    public function productExists(Request $request)
    {
        $items = $this->wishlistService->getWishlistByUser($this->auth->user());

        return ['exists' => $items->filter(function ($item) use ($request) {
            return $item->id == $request->product_id;
        })->count() > 0];
    }

}
