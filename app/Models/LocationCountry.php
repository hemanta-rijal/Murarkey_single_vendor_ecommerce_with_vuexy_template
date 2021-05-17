<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Class LocationCountry
 */
class LocationCountry extends Model
{
    use SearchableTrait;
    
    protected $table = 'location_countries';

    public $timestamps = false;

    protected $searchable = [
        'columns' => [
            'name' => 10,
        ]
    ];

    protected $fillable = [
        'sortname',
        'name',
        'phonecode'
    ];

    protected $guarded = [];

    public function states()
    {
        return $this->hasMany(LocationState::class, 'country_id');
    }

}