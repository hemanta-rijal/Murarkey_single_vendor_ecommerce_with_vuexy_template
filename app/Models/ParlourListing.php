<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParlourListing extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'address',
        'about',
        'category_id',
        'feature_image',
        'featured',
        'status',
        'phone',
        'mobile',
        'email',
        'website',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
    ];
    protected $appends = ['parlourServices'];

    public function approved_reviews()
    {
        return $this->hasMany(Review::class)->where('published', true);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->orderBy('rating', 'desc');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'parlour_has_services', 'parlour_id', 'service_id');
    }

    public function scopeOnlyApproved($query)
    {
        return $query->where('status', 1);
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

    public function getParlourServicesAttribute()
    {
        $services = $this->services()->get()->pluck('id');
        return $services->toArray();

    }
}
