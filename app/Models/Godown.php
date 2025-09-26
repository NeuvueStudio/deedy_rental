<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Godown extends Model
{
    protected $fillable = ['vendor_id', 'godown_address', 'pincode', 'contact_name', 'godown_mobile_no'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}