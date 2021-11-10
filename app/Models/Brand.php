<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'caption', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
