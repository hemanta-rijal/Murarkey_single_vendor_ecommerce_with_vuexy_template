<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Class Company
 */
class Company extends Model
{
    use Sluggable, SoftDeletes, SearchableTrait, CascadeSoftDeletes;

    const DEFAULT_LOGO = '/assets/img/new-default-logo.jpg';
    const DEFAULT_LOGO_SIZE = 200;

    protected $cascadeDeletes = ['products_obj', 'sellers', 'home_page_featured_company'];

    protected $table = 'companies';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'established_year',
        'business_type',
        'products',
        'operational_address',
        'country_id',
        'province',
        'city',
        'website',
        'government_business_permit',
        'description',
        'logo',
        'status',
        'owner_id',
        'delete_reason'
    ];

    protected $guarded = [];

    protected $casts = [
        'business_type' => 'json',
    ];

    protected $appends = [
        'cropped_logo'
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
            'companies.name' => 20,
            'companies.products' => 10,
        ]
    ];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function country()
    {
        return $this->belongsTo(LocationCountry::class);
    }

    public function province_obj()
    {
        return $this->belongsTo(LocationState::class, 'province');
    }


    public function city_obj()
    {
        return $this->belongsTo(LocationCity::class, 'city');
    }

    public function images()
    {
        return $this->hasMany(CompanyHasImage::class);
    }

    public function cover_photo()
    {
        return $this->hasOne(CompanyHasImage::class)->where('type', 'cover-photo');
    }

    public function company_photos()
    {
        return $this->hasMany(CompanyHasImage::class)->where('type', 'company-photo');
    }

    public function getFormatedCompanyPhotosAttribute()
    {
        $photos = $this->company_photos;
        $collection = collect([]);
        foreach ($photos as $photo)
            if ($photo->image)
                $collection->push($photo);

        if ($collection->count() == 0)
            $collection->push($photos->first());

        return $collection;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function products_obj()
    {
        return $this->hasMany(Product::class);
    }

    public function getFormatedStatusAttribute()
    {
        return formated_status($this->status);
    }

    public function getFormatedBusinessTypeAttribute()
    {
        return implode(', ', $this->business_type);
    }

    public function getLogo($size = '100X35')
    {
        return $this->logo ? resize_image_url($this->logo, $size) : self::DEFAULT_LOGO;
    }

    public function getCroppedLogoAttribute()
    {
        return $this->logo ? map_storage_path_to_link(get_cropped_image_path($this->logo)) : self::DEFAULT_LOGO;
    }

    public function getIsPendingAttribute()
    {
        return $this->status == 'pending';
    }

    public function getIsApprovedAttribute()
    {
        return $this->status == 'approved';
    }


    public function scopeOnlyApproved($query)
    {
        return $query->where('companies.status', 'approved');
    }

    public function featured_products()
    {
        return $this->hasMany(Product::class)->where('featured', 1)->onlyApproved();
    }

    public function approved_products()
    {
        return $this->hasMany(Product::class)->onlyApproved();
    }

    public function sellers()
    {
        return $this->hasMany(Seller::class);
    }

    public function associate_sellers()
    {
        return $this->sellers()->whereHas('user', function ($query) {
            return $query->where('role', '<>', User::MainSeller);
        });
    }

    public function home_page_featured_company()
    {
        return $this->hasMany(FeaturedCompany::class);
    }
}

