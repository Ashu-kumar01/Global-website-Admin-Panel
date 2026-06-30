<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RibbonNotice extends Model
{
    protected $fillable = [
        'ribbion_id',
        'name',
        'link',
        'file',
        'link_preference',
    ];

    public function ribbion()
    {
        return $this->belongsTo(Ribbion::class);
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->file ? \Illuminate\Support\Facades\Storage::url($this->file) : null;
    }

    public function getAnchorHrefAttribute(): ?string
    {
        if ($this->link && $this->file) {
            return $this->link_preference === 'file' ? $this->file_url : $this->link;
        }
 
        return $this->link ?: $this->file_url;
    }
}
