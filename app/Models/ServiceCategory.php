<?php

namespace App\Models;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kalnoy\Nestedset\NodeTrait;

class ServiceCategory extends Model
{
    use NodeTrait, SearchableTrait;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'parent_id',
        'featured',
        'slug',
        'icon_image',
        'banner_image',
        'description',
        'service_count',
    ];

    public function child_category()
    {
        return $this->hasMany(ServiceCategory::class, 'parent_id', 'id');
    }
    /**
     * Get the parent_category associated with the ServiceCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent_category(): HasOne
    {
        return $this->hasOne(ServiceCategory::class, 'id', 'parent_id');
    }
    /**
     * Get all of the services for the ServiceCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'category_id', 'id');
    }

    public function childrenCategories()
    {
        return $this->child_category()->with('childrenCategories');
    }

}
