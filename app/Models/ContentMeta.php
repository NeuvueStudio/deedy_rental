<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentMeta extends Model
{
    use HasFactory;    

    protected $table = 'content_meta';
    protected $fillable = ['content_id', 'meta_key', 'meta_value'];

    // Relationship: Meta belongs to one content
    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
