<?php

namespace App\Http\Controllers\API\V1;

use App\Events\BoughtFromDiscount;
use App\Events\CheckoutFromCartEvent;
use App\Modules\Cart\Requests\CheckoutFromBuyNowRequest;
use App\Modules\Cart\Requests\CheckoutRequest;
use App\Traits\SubscriptionDiscountTrait;
use Gloudemans\Shoppingcart\CartItem;
use Modules\Cart\Contracts\CartService;
use Modules\Orders\Contracts\OrderService;
use Modules\Products\Contracts\ProductService;

class CheckoutController extends BaseController
{
    use SubscriptionDiscountTrait;

    private $productService;

    private $orderService;

    private $cartService;


    public function __construct(ProductService $productService, OrderService $orderService, CartService $cartService)
    {
        $this->productService = $productService;

        $this->orderService = $orderService;

        $this->cartService = $cartService;


    }

    public function checkoutFromCart(CheckoutRequest $request)
    {
        $items = $this->cartService->getCartByUser($this->auth->user());


        $this->orderService->add($this->auth->user(), $items, $request->get('user'), $request->get('payment_method'));

        event(new CheckoutFromCartEvent(auth()->user()));


        return ['status' => 'ok'];
    }


    public function checkoutFromBuyNow(CheckoutFromBuyNowRequest $request)
    {
        $options = isset($request->get('item')['options']) ? $request->get('item')['options'] : [];
        $product = $this->productService->findById($request->get('item')['product_id']);

        $item = CartItem::fromBuyable($product, $options);
        $item->setQuantity($request->get('item')['qty']);
        $item->associate($product);


        $items = collect([$item]);

        $this->orderService->add($this->auth->user(), $items, $request->get('user'), $request->get('payment_method'));


        return ['status' => 'ok'];
    }
}
