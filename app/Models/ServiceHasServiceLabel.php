<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * The services that belong to the ServiceHasServiceLabel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_has_service_labels', 'service_id', 'label_id');
    }
}
