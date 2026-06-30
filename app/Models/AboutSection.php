<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'user_id',
        'badge',
        'heading',
        'subheading',
        'aboutPosition',
        'button_label',
        'aboutBtnLink',
        'aboutImage1Position',
        'aboutImage2Position',
        'image1',
        'image2'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
