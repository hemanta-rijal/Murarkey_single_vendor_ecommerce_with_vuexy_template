<?php


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
        $total = Cart::total();
        $tax = Cart::tax();
        $subTotal = Cart::subTotal();
        $shippingAmount = Cart::shippingAmount();

        // TODO
//        Cart::store($user->id);

        return [
            'content'=>$content,
            'total'=>$total,
            'tax'=>$tax,
            'subTotal'=>$subTotal,
            'shippingAmount'=>$shippingAmount
        ] ;
    }

    public function add($user, $data)
    {
        $var = (is_array($data['options'])) ? $data['options'] : $data['options'] = [$data['options']];
        $cart = Cart::restore($user->id);
        $options  = isset($data['options']) ? $data['options'] : [];
        $product = $this->productService->findById($data['product_id']);
        $cartItem =   Cart::add($product->id,$product->name,$data['qty'], $product->price_after_discount, $options);
        Cart::store($user->id);
        return $cartItem->rowId;

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