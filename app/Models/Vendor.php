<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['vendor_code', 'company_name', 'gst_no', 'owner_name', 'contact_no'];

    public function alternateContacts()
    {
        return $this->hasMany(AlternateContact::class);
    }

    public function godowns()
    {
        return $this->hasMany(Godown::class);
    }
}