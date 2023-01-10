<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attribute extends Model
{
    protected $fillable = ['name', 'value'];

    /**
     * attribute relations with products
     * @return BelongsToMany
     */
    public function products(){
        return $this->belongsToMany(Product::class,'product_has_attributes','product_id','attribute_id');
    }
}
