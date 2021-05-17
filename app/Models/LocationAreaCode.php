<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class LocationAreaCode extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'area_code' => 10,
        ]
    ];

    protected $fillable = [
        'area_code',
    ];
}
