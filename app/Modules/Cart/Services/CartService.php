<?php

namespace Modules\Cart\Services;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\Cart\Contracts\CartService as CartServiceContract;
use Modules\Products\Services\ProductService;

class CartService implements CartServiceContract
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getCartByUser($user)
    {
        Cart::restore($user->id);
        $content = Cart::instance('default')->content();
        $total = Cart::total();
        $tax = Cart::tax();
        $subTotal = Cart::subTotal();
        $shippingAmount = Cart::shippingAmount();

        // TODO
        Cart::store($user->id);

        return [
            'content' => $content,
            'total' => (int) str_replace(',', '', $total),
            'tax' => (int) str_replace(',', '', $tax),
            'subTotal' => (int) str_replace(',', '', $subTotal),
            'shippingAmount' => $shippingAmount,
        ];
    }

    public function add($user, $data)
    {
        $var = (is_array($data['options'])) ? $data['options'] : $data['options'] = [$data['options']];
        Cart::instance('default')->restore($user->id);
        $options = isset($data['options']) ? $data['options'] : [];
        $product = $this->productService->findById($data['product_id']);
        $cartItem = Cart::instance('default')->add($product->id, $product->name, $data['qty'], $product->price_after_discount, $options);
        $cartItem->associate(Product::class);
        $cartStatus = Cart::instance('default')->store($user->id);

    }

    public function delete($user, $rowId)
    {
        Cart::restore($user->id);

        Cart::remove($rowId);

        Cart::store($user->id);
    }
    public function clear($user)
    {
        Cart::restore($user->id);
        Cart::store($user->id);
    }

    public function update($user, $rowId, $data)
    {
        if (count($data) > 0) {
            Cart::restore($user->id);
            Cart::update($rowId, $data);
            Cart::store($user->id);
        }

    }

}
