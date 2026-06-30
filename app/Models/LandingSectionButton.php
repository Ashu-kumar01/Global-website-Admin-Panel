<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSectionButton extends Model
{
    protected $fillable = [
        'landing_section_id',
        'landing_section_slide_id',
        'label',
        'link',
        'order',
    ];

    public function landingSection()
    {
        return $this->belongsTo(LandingSection::class);
    }

    public function slide()
    {
        return $this->belongsTo(LandingSectionSlide::class, 'landing_section_slide_id');
    }
}