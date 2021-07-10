<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHasServiceLabel extends Model
{
    protected $fillable = [
        'service_id',
        'label_id',
        'label_value',
    ];
    /**
     * Get the service_label that owns the ServiceHasServiceLabel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service_label(): BelongsTo
    {
        return $this->belongsTo(ServiceLabel::class, 'label_id', 'id');
    }
}
