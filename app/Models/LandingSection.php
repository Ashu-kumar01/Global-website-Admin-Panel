<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingSection extends Model
{
    protected $fillable = [
        'user_id',
        'screen_type',
        'heading',
        'subheading',
        'position',
        'background_type',
        'background_color',
        'background_image',
        'background_gradient',
        'background_fade_opacity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function slides()
    {
        return $this->hasMany(LandingSectionSlide::class)->orderBy('order');
    }

    public function buttons()
    {
        return $this->hasMany(LandingSectionButton::class)->orderBy('order');
    }
}