<?php

namespace App\Http\Controllers\API\V1;

use App\Modules\Cart\Requests\DiscountRequest;
use App\Traits\SubscriptionDiscountTrait;
use Gloudemans\Shoppingcart\CartItem;
use Modules\Cart\Contracts\CartService;
use Modules\Products\Contracts\ProductService;

class DiscountController extends BaseController
{
    use SubscriptionDiscountTrait;

    private $cartService;

    private $productService;

    public function __construct(CartService $cartService, ProductService $productService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    public function forCart()
    {
        $items = $this->cartService->getCartByUser($this->auth->user());
        return $this->processItems($items);
    }

    public function forBuyNow(DiscountRequest $request)
    {
        $options = isset($request->get('item')['options']) ? $request->get('item')['options'] : [];
        $product = $this->productService->findById($request->get('item')['product_id']);

        $item = CartItem::fromBuyable($product, $options);
        $item->setQuantity($request->get('item')['qty']);
        $item->associate($product);

        $items = collect([$item]);

        return $this->processItems($items);
    }
}
