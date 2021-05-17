<?php

namespace App\Models;

use App\Models\LocationState;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class LocationCity extends Model
{
    use SearchableTrait;

    protected $table = 'location_cities';

    public $timestamps = false;

    protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];

    protected $fillable = [
        'name',
        'state_id',
        'cod_available',
    ];

    protected $guarded = [];

    public function state()
    {
        // $state = $this->belongsTo(LocationState::class);
        // dd($state);
        return $this->belongsTo(LocationState::class);
    }
}
