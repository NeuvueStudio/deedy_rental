<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternateContact extends Model
{
    protected $fillable = ['vendor_id', 'alternate_name', 'alternate_no'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}