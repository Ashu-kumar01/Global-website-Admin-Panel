<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlacementSection extends Model
{
    protected $fillable = [
        'user_id',
        'badge',
        'heading',
        'subheading',
        'highest_package',
        'average_package',
        'total_recruiters',
        'design_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logos()
    {
        return $this->hasMany(PlacementLogo::class)->orderBy('order');
    }
}
