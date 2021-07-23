<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/8/18
 * Time: 4:02 PM
 */

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{

    const ORDER_INITIAL = 'initial';
    const ORDER_CONFIRMED = 'confirmed';
    const ORDER_PRE_PROCESSING = 'pre-processing';
    const ORDER_PROCESSING = 'processing';
    const ORDER_HOLD = 'hold';
    const ORDER_SHIPPED = 'shipped';
    const ORDER_DISPATCH = 'dispatch';
    const ORDER_CANCEL = 'cancelled';

    const ALL_ORDERS = [
        self::ORDER_INITIAL,
        self::ORDER_CONFIRMED,
        self::ORDER_PRE_PROCESSING,
        self::ORDER_PROCESSING,
        self::ORDER_HOLD,
        self::ORDER_SHIPPED,
        self::ORDER_DISPATCH,
        self::ORDER_CANCEL,
    ];

    const NON_RECONCILE = [
        self::ORDER_INITIAL,
        self::ORDER_CONFIRMED,
        self::ORDER_PRE_PROCESSING,
    ];

    protected $table = 'order_item';

    protected $casts = [
        'options' => 'json',
//        'scan_at' => 'datetime'
    ];

    protected $fillable = [
        'product_id',
        'qty',
        'price',
        'options',
        'order_id',
        'product_link',
        'remarks',
        'seller_order_no',
        'seller_awb_no',
        'status',
        'scan_at',
    ];

    public static function fromCartItem($cartItem)
    {
        $orderItem = new self();
        $orderItem->product()->associate($cartItem->model);
        $orderItem->qty = $cartItem->qty;
        $orderItem->options = $cartItem->options;
        $orderItem->price = $cartItem->price;
        $orderItem->status = $cartItem->status;

        if ($cartItem->doDiscount) {
            $orderItem->remarks = '50% off';
        }

        return $orderItem;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // public function service()
    // {
    //     return $this->belongsTo(Service::class);
    // }
    /**
     * Get the service that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'product_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTotalAttribute()
    {
        return $this->attributes['qty'] * $this->attributes['price'];
    }
}
