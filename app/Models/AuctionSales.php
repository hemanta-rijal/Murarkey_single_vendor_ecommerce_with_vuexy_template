<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionSales extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'cancelled'
    ];

    protected $appends = [
        'maxBidAmount'
    ];


    protected $_maxBidPrice = null;


    public static function stdObjectToModel($obj)
    {
        $instance = new AuctionSales();

        foreach (array_merge(['id', 'created_at', 'updated_at'], $instance->fillable) as $field) {
            $instance->{$field} = $obj->{$field};
        }

        return $instance;
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMaxBidAmountAttribute()
    {
        return $this->_maxBidPrice;
    }

    public function setMaxBidAmountAttribute($v)
    {
        $this->_maxBidPrice = $v;
    }
}
