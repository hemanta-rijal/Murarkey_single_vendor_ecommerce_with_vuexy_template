<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHasServiceLabel extends Model
{
    // protected $table = 'service_has_labels';
    protected $fillable = [
        'label_id',
        'service_id',
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
