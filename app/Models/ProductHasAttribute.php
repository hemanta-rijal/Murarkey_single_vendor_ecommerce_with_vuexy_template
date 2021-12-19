<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\URL;

/**
 * Class ProductHasAttribute
 */
class ProductHasAttribute extends Model
{
    protected $table = 'product_has_attributes';

    public $timestamps = false;

    protected $fillable = [
        'key',
        'value',
        'product_id',
        'attribute_id',
    ];

    protected $guarded = [];

    /**
     * Get the attribute that owns the ProductHasAttribute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }

    public function setHyperLinkOnValue(){
        if($this->value!=null){
            $string ='';
            $values = explode(',',$this->value);
            foreach($values as $value){
                $string.=sprintf('<a href="'.URL::to('products/search').'?attribute=%s" style="color: blue;">%s</a> ,',$value,$value);
            }
            return $string;
        }
        return null;
    }

//    public function getAttributeAttribute(){
//        dd($this->attribute->name);
//    }
}
