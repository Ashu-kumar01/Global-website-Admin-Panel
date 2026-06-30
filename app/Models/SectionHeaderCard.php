<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionHeaderCard extends Model
{
    protected $fillable = [
        'section_header_id',
        'layout',
        'card_type',
        'is_featured',
        'order',
        'icon',
        'icon_color',
        'icon_bg_color',
        'heading',
        'subheading',
        'background_type',
        'background_color',
        'background_image',
        'image_overlay_color',
        'image_overlay_opacity',
        'image_border_radius',
        'image_position',
        'image_size',
        'gradient_type',
        'gradient_color_1',
        'gradient_color_2',
        'gradient_angle',
        'overlay_color',
        'overlay_opacity',
        'cta_text',
        'cta_link',
        'button_style',
        'button_radius',
        'button_bg_color',
        'button_text_color',
        'button_hover_bg_color',
        'button_hover_text_color',
        'hover_effect',
        'animation_type',
        'animation_delay',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(SectionHeader::class, 'section_header_id');
    }
}
