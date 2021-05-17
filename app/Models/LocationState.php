<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * Class LocationState
 */
class LocationState extends Model
{
    use SearchableTrait;

    protected $table = 'location_states';

    public $timestamps = false;

    protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];

    protected $fillable = [
        'name',
        'country_id',
    ];

    protected $guarded = [];

    public function cities()
    {
        return $this->hasMany(LocationCity::class, 'state_id');
    }

    public function country()
    {
        return $this->belongsTo(LocationCountry::class);
    }
}
