<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use SearchableTrait;

    const ORDER_INITIAL = 'initial';
    const ORDER_CONFIRMED = 'confirmed';
    const ORDER_PRE_PROCESSING = 'processing';
    const ORDER_SHIPPED = 'shipped';
    const ORDER_DISPATCH = 'dispatch';
    const ORDER_CANCEL = 'cancelled';

    const PAYMENT_COD = 'cod';
    const PAYMENT_PREPAID = 'prepaid';

    const STATUS = [
        self::ORDER_INITIAL,
        self::ORDER_CONFIRMED,
        self::ORDER_PRE_PROCESSING,
        self::ORDER_SHIPPED,
        self::ORDER_DISPATCH,
        self::ORDER_CANCEL,
    ];

    const PAYMENT_METHOD = [
        self::PAYMENT_PREPAID,
        self::PAYMENT_COD,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.email' => 15,
            'users.phone_number' => 15,
        ],

        'joins' => [
            'users' => ['orders.user_id', 'users.id'],
        ],
    ];

    protected $table = 'orders';

    protected $casts = [
        'shipment_details' => 'json',
        'billing_details' => 'json',
    ];

    protected $appends = [
        'voucher_url',
        'total',
    ];

    protected $fillable = [
        'user_id',
        'company_id',
        'status',
        'shipment_details',
        'payment_method',
        'voucher_path',
        'remarks',
        'delivery_date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->total;
        }

        return $total;
    }

    public function getIsPrepaidAttribute()
    {
        return $this->attributes['payment_method'] == self::PAYMENT_PREPAID;
    }

    public function getVoucherUrlAttribute()
    {
        if (isset($this->attributes['voucher_path']) && $this->attributes['voucher_path']) {
            return map_storage_path_to_link($this->attributes['voucher_path']);
        }

    }

    public function getIsCancelAttribute()
    {
        return $this->attributes['status'] == Order::ORDER_CANCEL;
    }

    public function getCanCancelAttribute()
    {
        return $this->attributes['status'] == Order::ORDER_INITIAL;
    }

    public function getDeliveryDateAttribute()
    {
        return $this->created_at->addDays(20)->format('jS F');
    }
}
