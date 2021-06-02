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

    public function getCartByUser($user)
    {
        Cart::instance('wishlist')->restore($user->id);

        $content = Cart::content();

        // TODO
//        Cart::store($user->id);

        return $content;
    }

    public function add($user, $data)
    {
        // dd($data);
        Cart::instance('wishlist')->restore($user->id);

        $options = isset($data['options']) ? $data['options'] : [];

        Cart::instance('wishlist')->add($this->productService->findById($data['product_id']), $data['qty'], $options);

        Cart::store($user->id);
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