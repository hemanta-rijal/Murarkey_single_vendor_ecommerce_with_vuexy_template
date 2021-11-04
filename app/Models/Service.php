<?php

namespace App\Models;

use App\Models\Review;
use App\Models\ServiceCategory;
use App\Models\ServiceHasImage;
use App\Models\ServiceHasServiceLabel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'duration',
        'icon_image',
        'category_id',
        'min_duration',
        'min_duration_unit',
        'max_duration',
        'max_duration_unit',
        'short_description',
        'description',
        'popular',
        'service_charge',
        'a_discount_price',
        'discount_type',
    ];

    protected $appends = [
        'featured_image','avgRating'
    ];

    public function labels()
    {
        return $this->hasMany(ServiceHasServiceLabel::class);
    }
    public function images()
    {
        return $this->hasMany(ServiceHasImage::class);
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
    /**
     * Get the serviceCategory that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id', 'id');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function getAvgRatingAttribute()
    {
        if ( ! array_key_exists('reviews', $this->relations)) {
            $this->load('reviews');
        }

        $relation = $this->getRelation('reviews')->first();

        return ($relation) ? $relation->aggregate : null;
    }

}
