<?php

namespace Modules\Cart\Services;

use App\Models\Product;
use App\Models\Service;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\Cart\Contracts\CartService as CartServiceContract;
use Modules\Products\Services\ProductService;
use Modules\Service\Contracts\ServiceService;

class CartService implements CartServiceContract
{

    private $productService;
    private $servicesService;

    public function __construct(ProductService $productService, ServiceService $servicesService)
    {
        $this->productService = $productService;
        $this->servicesService = $servicesService;
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
        dd($data);
        (is_array($data['options'])) ? $data['options'] : $data['options'] = [$data['options']];
        $data['options']['timestamp']= time();
        Cart::instance('default')->restore($user->id);
        $options = isset($data['options']) ? $data['options'] : [];
        if ($data['type'] == 'service') {
            $service = $this->servicesService->findById($data['product_id']);
            $options['photo']= resize_image_url($service->featured_image,'200X200');
            $taxRate = 0;
            $cartItem = Cart::instance('default')->add($service->id, $service->title, $data['qty'], $service->applyDiscount(), $options);
            $cartItem->setTaxRate(0);
            $cartItem->associate(Service::class);
        } else {
            $product = $this->productService->findById($data['product_id']);

            $cartItem = Cart::instance('default')->add($product->id, $product->name, $data['qty'], $product->applyDiscount(), $options);
            $cartItem->setTaxRate(13);
            $cartItem->associate(Product::class);
        }
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

    public function applyCouponForCart($couponDetail){
//        if ($couponDetail[''])
    }

}
