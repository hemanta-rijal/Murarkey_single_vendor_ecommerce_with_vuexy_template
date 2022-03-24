<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'rating',
        'comment',
        'reviewable_id',
        'reviewable_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function reviewable()
    {
        return $this->morphTo();
    }

    public function getFormatedCreatedAtAttribute()
    {
        return $this->created_at->toDayDateTimeString();
    }

}
