<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyHasImage
 */
class CompanyHasImage extends Model
{
    protected $table = 'company_has_images';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'image',
        'position_x',
        'position_y',
        'company_id',
        'modification_details'
    ];

//    protected $casts = [
//        'modification_details' => 'json',
//    ];

    public static $size = [
        'logo' => [],
        'cover-photo' => [1108, 400],
        'company-photo' => [400, 400]
    ];

    protected $appends = [
        'image_url',
        'cropped_image_url'
    ];


    public static $defaultImage = [
        'logo' => '',
        'cover-photo' => '/assets/img/new-default-cover-photo.jpg',
        'company-photo' => '/assets/img/new-default-company-photo.jpg'
    ];

    protected $guarded = [];

    public function company()
    {
        $this->belongsTo(Company::class);
    }

    public function getPositionAttribute()
    {
        return $this->position_x . ' ' . $this->position_y;
    }

    public function setModificationDetailsAttribute($value)
    {
        $this->attributes['modification_details'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getImageUrlAttribute()
    {
        return map_storage_path_to_link($this->attributes['image']);
    }

    public function getCroppedImageUrlAttribute()
    {
        return $this->attributes['image'] ? map_storage_path_to_link(get_cropped_image_path($this->attributes['image'])) : (self::$defaultImage[$this->attributes['type']]);
    }

    public function getRawCroppedPathAttribute()
    {
        return $this->attributes['image'] ? get_cropped_image_path($this->attributes['image']) : public_path(self::$defaultImage[$this->attributes['type']]);
    }

}