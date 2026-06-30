<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSectionCard extends Model
{
    protected $fillable = [
        'course_section_id',
        'order',
        'heading',
        'subheading',
        'short_description',
        'course_type',
        'duration',
        'badge',
        'explore_text',
        'explore_link',
        'image',
        'background_color',
    ];

    public function section()
    {
        return $this->belongsTo(CourseSection::class, 'course_section_id');
    }
}
