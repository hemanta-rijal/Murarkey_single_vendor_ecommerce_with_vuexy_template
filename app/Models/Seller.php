<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Seller
 */
class Seller extends Model
{
    use SoftDeletes;

    protected $table = 'sellers';

    protected $countries = null;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'position',
        'mobile_number',
        'landline_number',
        'fax',
        'skype',
        'wechat',
        'viber',
        'whatsapp',
        'user_id',
        'company_id'
    ];

    protected $guarded = [];

    protected $casts = [
        'mobile_number' => 'json',
        'landline_number' => 'json',
        'fax' => 'json'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPresentableMobileNumberAttribute()
    {
        return $this->generatePresentAble('mobile_number');
    }

    public function getPresentableLandlineNumberAttribute()
    {
        return $this->generatePresentAble('landline_number');
    }

    public function getPresentableFaxAttribute()
    {
        return $this->generatePresentAble('fax');
    }

    private function generatePresentAble($type)
    {
        if (!$this->countries)
            $this->countries = get_countries_with_phone_code();

        $presentable = [];
        if ($this->{$type})
            foreach ($this->{$type} as $number)
                if (!empty($number['type']))
                    if (isset($number['area_code']) && !empty($number['area_code']))
                        $presentable[] = $this->countries[$number['type']] . ' ' . $number['area_code'] . $number['number'];
                    else
                        $presentable[] = $this->countries[$number['type']] . ' ' . $number['number'];

        return $presentable;
    }


    private function generatePresentAbleA($type)
    {

        $presentable = [];

        if ($this->{$type})
            foreach ($this->{$type} as $number)
                if (!empty($number['type'])) {
                    if (isset($number['area_code']) && !empty($number['area_code']))
                        $presentable[] = '(+' . $number['type'] . ') ' . $number['area_code'] . $number['number'];
                    else
                        $presentable[] = '(+' . $number['type'] . ') ' . $number['number'];
                }


        return $presentable;
    }


    public function getPresentableMobileNumberAAttribute()
    {
        return $this->generatePresentAbleA('mobile_number');
    }

    public function getPresentableLandlineNumberAAttribute()
    {
        return $this->generatePresentAbleA('landline_number');
    }

    public function getPresentableFaxAAttribute()
    {
        return $this->generatePresentAbleA('fax');
    }

    public function setFaxAttribute($value)
    {
        foreach ($value as $key => $val)
            if (!isset($val['number']) || !$val['number']) unset($value[$key]);

        $this->attributes['fax'] = json_encode($value);
    }
}