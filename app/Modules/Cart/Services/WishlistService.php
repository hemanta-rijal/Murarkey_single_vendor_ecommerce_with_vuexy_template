<?php

namespace Modules\Cart\Services;

use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\Cart\Contracts\WishlistService as WishlistServiceContract;
use Modules\Products\Services\ProductService;

class WishlistService implements WishlistServiceContract
{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getWishlistByUser($user)
    {
        Cart::instance('wishlist')->restore($user->id);

        $content = Cart::instance('wishlist')->content();

        // TODO
        Cart::instance('wishlist')->store($user->id);
        return [
            'content' => $content,
        ];

        // return $content;
    }

    public function add($user, $data)
    {
        $var = (is_array($data['options'])) ? $data['options'] : $data['options'] = [$data['options']];
        Cart::instance('wishlist')->restore($user->id);
        $options = isset($data['options']) ? $data['options'] : [];
        $product = $this->productService->findById($data['product_id']);
        $cartItem = Cart::instance('wishlist')->add($product->id, $product->name, $data['qty'], $product->price_after_discount, $options);
        $cartItem->associate(Product::class);
        $cartStatus = Cart::instance('wishlist')->store($user->id);

    }

    public function delete($user, $rowId)
    {
        Cart::instance('wishlist')->restore($user->id);

        Cart::instance('wishlist')->remove($rowId);

        Cart::instance('wishlist')->store($user->id);
    }

    public function update($user, $rowId, $data)
    {
        if (count($data) > 0) {
            Cart::instance('wishlist')->restore($user->id);
            Cart::instance('wishlist')->update($rowId, $data);
            Cart::instance('wishlist')->store($user->id);
        }

    }

}
