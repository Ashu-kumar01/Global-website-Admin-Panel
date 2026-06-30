<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionHeader extends Model
{
    protected $fillable = [
        'user_id',
        'badge',
        'heading',
        'heading_accent_text',
        'heading_accent_color',
        'heading_color',
        'subheading',
        'subheading_color',
        'layout_type',
        'grid_columns_desktop',
        'grid_columns_tablet',
        'grid_columns_mobile',
        'grid_gap',
        'card_height',
        'card_border_radius',
        'card_shadow',
        'hover_animation',
        'image_zoom_hover',
        'card_alignment',
        'split_featured_position',
        'card_view_columns',
        'section_background_type',
        'section_background_color',
        'section_background_image',
        'section_gradient_type',
        'section_gradient_color_1',
        'section_gradient_color_2',
        'section_gradient_angle',
        'section_gradient_opacity',
        'padding_top',
        'padding_bottom',
        'hover_shadow',
        'card_spacing',
        'alignment',
        'cta_text',
        'cta_link',
    ];

    protected $casts = [
        'card_shadow' => 'boolean',
        'image_zoom_hover' => 'boolean',
        'hover_shadow' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cards()
    {
        return $this->hasMany(SectionHeaderCard::class)->orderBy('order');
    }
}