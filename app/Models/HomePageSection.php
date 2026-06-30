<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSection extends Model
{
    protected $fillable = [
        'home_page_id',
        'section_key',
        'priority',
        'is_configured',
        'meta',
    ];

    protected $casts = [
        'is_configured' => 'boolean',
        'meta' => 'array',
    ];

    public function homePage()
    {
        return $this->belongsTo(HomePage::class);
    }
}
