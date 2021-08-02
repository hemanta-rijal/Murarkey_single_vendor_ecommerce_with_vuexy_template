<?php

namespace App\Http\Controllers\API\V1;

use App\Http\ApiRequests\ApiCartRequest;
use App\Http\ApiRequests\ApiCartUpdateRequest;
use Gloudemans\Shoppingcart\Exceptions\CartAlreadyStoredException;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Gloudemans\Shoppingcart\Exceptions\UnknownModelException;
use Modules\Cart\Services\WishlistService;
use PDOException;

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
        try {
            $items = $this->wishlistService->getWishlistByUser($this->auth->user());
            if ($items['content']->filter(function ($item) use ($request) {
                return $item->id == $request->product_id;
            })->count() > 0) {
                return response()->json(['success' => false, 'message' => 'Item already exists in wishlist', 'status' => 500]);
            }

            $this->wishlistService->add($this->auth->user(), $request->all());
            return response()->json(['success' => true, 'message' => 'Item added in wishlist', 'status' => 200]);
        } catch (UnknownModelException $exception) {
            return response()->json(['data' => '', 'message' => $exception->getMessage(), 'status' => 400]);
        } catch (InvalidRowIDException $exception) {
            return response()->json(['data' => '', 'message' => $exception->getMessage(), 'status' => 400]);
        } catch (\PDOException $exception) {
            return response()->json(['data' => '', 'message' => $exception->getMessage(), 'status' => 400]);
        } catch (CartAlreadyStoredException $already) {
            return response()->json(['data' => '', 'message' => $exception->getMessage(), 'status' => 400]);
        }
        // if ($items->filter(function ($item) use ($request) {
        //     return $item->id == $request->product_id;
        // })->count() > 0) {
        //     return response()->json(['success' => false, 'message' => 'Item already exists in wishlist', 'status' => 500]);
        // }

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
