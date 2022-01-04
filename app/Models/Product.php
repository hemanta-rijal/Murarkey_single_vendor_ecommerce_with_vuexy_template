<?php

namespace App\Models;

use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use App\Events\ProductUpdated;
use App\Traits\SearchableTrait;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 */
class Product extends Model implements Buyable
{

    use SoftDeletes, SearchableTrait, CascadeSoftDeletes;

    public $reviewCount; // one cant access this var till averageRating() is called
    public static $searchOrderBy = true;
    public static $relationship = ['images', 'attributes', 'keywords', 'reviews.user'];
    protected $table = 'products';
    protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['home_page_company_featured', 'home_page_category_featured', 'order_item'];
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 8,
//            'products.brand_name' => 5,
            'products.id' => 60,
            'product_has_keywords.name' => 25,
            'category_keywords.keyword' => 40,
        ],
        'joins' => [
            'product_has_keywords' => ['products.id', 'product_has_keywords.product_id'],
            'category_keywords' => ['products.category_id', 'category_keywords.category_id'],
        ],
    ];
    protected $dispatchesEvents = [
        'created' => ProductCreated::class,
        'updated' => ProductUpdated::class,
        'deleted' => ProductDeleted::class,
    ];
    protected $fillable = [
        'name',
        'slug',
        'model_number',
        'brand_id',
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
        'made_in',
        'price',
        'size_chart',
        'discount_rates',
        'discount_type',
        'sku',
        'total_product_units',
        'skin_tone',
        'skin_concern',
        'product_type'
    ];
    protected $guarded = [];

    protected $appends = [
        'available_colors',
        'available_sizes',
        'has_discount',
        'discount_price',
        'discount_price_percentage',
        'price_after_discount',
        'featured_image',
        'stock',

    ];

    public function attributes()
    {
        return $this->hasMany(ProductHasAttribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductHasImage::class);
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

    public function rel_keywords()
    {
        return $this->hasMany(ProductHasKeyword::class);
    }

    public function trade_infos()
    {
        return $this->hasMany(ProductHasTradeInfo::class)->orderBy('moq');
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
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

//    public function getPriceAttribute()
    //    {
    //        return $this->trade_infos->first()->price . ' - ' . $this->trade_infos->last()->price;
    //    }

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
            if ($nextInfo) {
                $info->formated_moq = $info->moq . ' - ' . ($nextInfo->moq - 1);
            } else {
                $info->formated_moq = '≥ ' . $info->moq;
            }

        }

        return $tradeInfos;
    }

    public function scopeOnlyApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function home_page_company_featured()
    {
        return $this->hasMany(FeaturedCompaniesHasProduct::class);
    }

    public function home_page_category_featured()
    {
        return $this->hasMany(FeaturedCategoriesHasProduct::class);
    }

    public function order_item()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function approved_reviews()
    {
        return $this->hasMany(Review::class)->where('published', true);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->orderBy('rating', 'desc');
    }

    public function averageRating()
    {
        $reviewInfo = get_reviews_info($this->id);

        $reviewInfo = $reviewInfo->map(function ($item) {
            $item->rcp = $item->rating * $item->review_count;
            return $item;
        });
        $this->reviewCount = $reviewInfo->sum('review_count');
        if ($reviewInfo->count() > 0) {
            $avgRating = $reviewInfo->sum('rcp') / $reviewInfo->sum('review_count');
        } else {
            $avgRating = 0;
        }

        return ceil($avgRating);
    }

    public function getPriceAfterDiscountAttribute()
    {
        $priceAfterDiscount = 0;

//        if ($this->has_discount) //i.e. flash sale discount
//        {
//            return $this->price - $this->flash_sale_item->discount;
//        }

        // if ($this->discount_type == "cash_back") {
        //     return $this->price;
        // }

        if ($this->discount_type == "flat_rate") {
            return $this->price - $this->discount_rates;
        }

        if ($this->discount_type == "percentage") {
          return    ($this->price * (100 - $this->discount_rates)) / 100;
        }
        if ($this->discount_type == "discount_price") {
            return $this->price - $this->discount_rates;

        }
        return $this->price;

    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return [
            'title' => $this->attributes['name'],
            'image' => $this->images,
        ];
    }

    public function getBuyablePrice($options = null)
    {
        return $this->getDiscountPriceAttribute();
    }

    public function getDiscountPriceAttribute()
    {
        if ($this->a_discount_price) {
            return $this->a_discount_price;
        }

        if ($this->has_discount) {
            return ceil($this->attributes['price'] * (1 - $this->flash_sale_item->discount / 100));
        }

        return $this->attributes['price'];
    }

    public function getFeaturedImageAttribute()
    {
        if ($this->images) {
            if ($this->images->first()) {
                return $this->images->first()->image;
            }
        }
        return null;
    }

    public function getDiscountPricePercentageAttribute()
    {
        if ($this->has_discount) //i.e. flash sale discount
        // return $this->price - $this->flash_sale_item->discount;
        {
            return ceil((1 - ($this->flash_sale_item->discount / $this->price)));
        }

        if ($this->a_discount_price) {
            if ($this->discount_type === 'discount_percentage') {
                return $this->a_discount_price;
            }
        }

        return ceil((1 - ($this->a_discount_price / $this->price)));

        return $this->attributes['price'];
    }

    public function getAvailableColorsAttribute()
    {
        $this->loadMissing('attributes');
        $attributes = $this->relations['attributes'];

        $colors = [];

        foreach ($attributes as $attribute) {
            $lowerKey = strtolower($attribute->key);
            if ($lowerKey === 'color' || $lowerKey == 'colour') {
                $colors[] = $attribute->value;
            }

        }

        return $colors;
    }

    public function getAvailableSizesAttribute()
    {
        $this->loadMissing('attributes');
        $attributes = $this->relations['attributes'];

        $sizes = [];

        foreach ($attributes as $attribute) {
            $lowerKey = strtolower($attribute->key);
            if ($lowerKey === 'size') {
                $sizes[] = $attribute->value;
            }

        }

        return $sizes;
    }

    public function flash_sale_item()
    {
        return $this->hasOne(FlashSaleItem::class)
            ->join('flash_sales', 'flash_sales.id', '=', 'flash_sale_items.flash_sale_id')
            ->where('flash_sales.published', true)
            ->where('flash_sales.start_time', '<=', Carbon::now())
            ->where('flash_sales.end_time', '>=', Carbon::now())
            ->orderBy('flash_sales.weight', 'DESC');
    }

    public function getHasDiscountAttribute()
    {
        if ($this->flash_sale_item) {
            return true;
        }

        return false;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->has_discount) {
            return $this->flash_sale_item->discount;
        }
    }

//    public function getSizeChartAttribute()
    //    {
    //        return $this->attributes['size_chart'] ? $this->attributes['size_chart'] : view('partials.size-chart');
    //    }

}
