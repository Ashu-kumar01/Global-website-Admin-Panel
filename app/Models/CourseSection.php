<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $fillable = [
        'user_id',
        'heading',
        'subheading',
        'design_type',
        'image',
        'image_position',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cards()
    {
        return $this->hasMany(CourseSectionCard::class)->orderBy('order');
    }
}
