<?php

namespace App\Models;

use App\Traits\SearchableTrait;
use Illuminate\Database\Eloquent\Model;
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
        'description',
        'service_count',
    ];
    public function rel_services(){
        return $this->hasMany('App\Models\Service','category_id','id');
    }

}
