<?php

namespace App\Models;

use App\Models\ServiceCategory;
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
        'featured_image',
        'short_description',
        'description',
        'popular',
        'service_charge',
    ];



    public function labels()
    {
        return $this->hasMany(ServiceHasServiceLabel::class);
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

}
