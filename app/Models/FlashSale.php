<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'weight',
        'published'
    ];

    protected $dates = [
        'start_time',
        'end_time'
    ];

    public function items()
    {
        return $this->hasMany(FlashSaleItem::class, 'flash_sale_id', 'id');
    }
}
