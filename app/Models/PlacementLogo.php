<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlacementLogo extends Model
{
    protected $fillable = [
        'placement_section_id',
        'order',
        'image',
        'company_name',
        'link',
    ];

    public function section()
    {
        return $this->belongsTo(PlacementSection::class, 'placement_section_id');
    }
}
