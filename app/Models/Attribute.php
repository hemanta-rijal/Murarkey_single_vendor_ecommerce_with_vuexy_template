<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name', 'value'];

    public function products(){
        return $this->belongsToMany(Product::class,'product_has_attributes','product_id','attribute_id');
    }
}
