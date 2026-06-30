<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSectionSlide extends Model
{
    protected $fillable = [
        'landing_section_id',
        'heading',
        'subheading',
        'position',
        'background_type',
        'background_color',
        'background_image',
        'background_gradient',
        'background_fade_opacity',
        'order',
    ];

    public function landingSection()
    {
        return $this->belongsTo(LandingSection::class);
    }

    public function buttons()
    {
        return $this->hasMany(LandingSectionButton::class)->orderBy('order');
    }
}