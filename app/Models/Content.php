<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    //
    //use HasFactory;    

    protected $table = 'contents';
    protected $fillable = ['post_title', 'post_name', 'post_content', 'post_type', 'post_status', 'parent_id', 'post_date'];

    public function meta(): HasMany
    {
        return $this->hasMany(ContentMeta::class, 'content_id');
    }

    // Helper: Get a meta value by key
    public function getMeta(string $key): ?string
    {
        return optional($this->meta->firstWhere('meta_key', $key))->meta_value;
    }
}
