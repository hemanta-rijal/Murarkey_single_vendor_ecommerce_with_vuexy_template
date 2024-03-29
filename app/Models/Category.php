<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kalnoy\Nestedset\NodeTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Class Category
 */
class Category extends Model
{
    use NodeTrait, SearchableTrait;

    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'slug',
        'product_count',
        'icon_path',
        'image_path',
        'size_chart',
        'featured',
    ];

    protected $guarded = [];

    protected $appends = [
        'icon_url',
        'image_url',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'name' => 12,
        ],
    ];

    public function parent_category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function child_category()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function getIconUrlAttribute()
    {
        if (isset($this->attributes['icon_path']) && $this->attributes['icon_path']) {
            return map_storage_path_to_link($this->attributes['icon_path']);
        }

    }

    public function getImageUrlAttribute()
    {
        if (isset($this->attributes['image_path']) && $this->attributes['image_path']) {
            return map_storage_path_to_link($this->attributes['image_path']);
        }

    }

    public function keywords()
    {
        return $this->hasMany(CategoryKeyword::class);
    }

}
