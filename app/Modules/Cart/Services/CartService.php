<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/4/18
 * Time: 8:53 AM
 */

namespace Modules\Cart\Services;


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

        $content = Cart::content();

        // TODO
//        Cart::store($user->id);

        return $content;
    }

    public function add($user, $data)
    {
        $var = (is_array($data['options'])) ? $data['options'] : $data['options'] = [$data['options']];
        Cart::restore($user->id);
        $options  = isset($data['options']) ? $data['options'] : [];
        $product = $this->productService->findById($data['product_id']);
        Cart::add($product->id,$product->name,$data['qty'], $product->price, $options);
        Cart::store($user->id);
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