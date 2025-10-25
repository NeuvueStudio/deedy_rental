<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'vendor_id', 'category_id', 'sub_category_id', 'material_id',
        'image', 'colors', 'quality_rating', 'rent_per_day', 'godown_id'
    ];

    /**
     * Get the vendor that owns the product.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the godown that stores the product.
     */
    public function godown()
    {
        return $this->belongsTo(Godown::class);
    }
}
