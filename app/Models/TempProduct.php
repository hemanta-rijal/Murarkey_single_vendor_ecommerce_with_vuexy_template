<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Product
 */
class TempProduct extends Model
{
    protected $table = 'temp_products';

    protected $fillable = [
        'name',
        'model_number',
        'brand_name',
        'place_of_origin',
        'details',
        'unit_type',
        'seller_id',
        'company_id',
        'featured',
        'shipping_details',
        'packing_details',
        'category_id',
        'status',
        'assembled_in',
        'made_in'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public static $relationship = ['images', 'trade_infos', 'attributes', 'keywords'];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            foreach (TempProduct::$relationship as $r)
                $product->{$r}()->delete();
        });
    }


    public function attributes()
    {
        return $this->hasMany(TempProductHasAttribute::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(TempProductHasImage::class, 'product_id');
    }

    public function origin()
    {
        return $this->belongsTo(LocationCountry::class, 'place_of_origin');
    }

    public function made_in_obj()
    {
        return $this->belongsTo(LocationCountry::class, 'made_in');
    }

    public function assembled_in_obj()
    {
        return $this->belongsTo(LocationCountry::class, 'assembled_in');
    }

    public function keywords()
    {
        return $this->hasMany(TempProductHasKeyword::class, 'product_id');
    }

    public function trade_infos()
    {
        return $this->hasMany(TempProductHasTradeInfo::class, 'product_id')->orderBy('moq');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceAttribute()
    {
        return $this->trade_infos->first()->price . ' - ' . $this->trade_infos->last()->price;
    }

    public function getMoqAttribute()
    {
        return $this->trade_infos->first()->moq;
    }

    public function getFormatedStatusAttribute()
    {
        return formated_status($this->status);
    }

    public function getIsPendingAttribute()
    {
        return $this->status == 'pending';
    }

    public function loadBasicRelationship()
    {
        $this->load(self::$relationship);
    }


    public function formatedTradeInfos()
    {
        $tradeInfos = $this->trade_infos->sortBy('moq');
        foreach ($tradeInfos as $index => $info) {
            $nextInfo = $tradeInfos->get($index + 1);
            if ($nextInfo)
                $info->formated_moq = $info->moq . ' - ' . ($nextInfo->moq - 1);
            else
                $info->formated_moq = '≥ ' . $info->moq;
        }

        return $tradeInfos;
    }

    public function scopeOnlyApproved($query)
    {
        return $query->where('status', 'approved');
    }
}