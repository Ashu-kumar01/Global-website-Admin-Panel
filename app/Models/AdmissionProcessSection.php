<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionProcessSection extends Model
{
    protected $fillable = [
        'user_id',
        'badge',
        'heading',
        'subheading',
        'cta_text',
        'cta_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function steps()
    {
        return $this->hasMany(AdmissionProcessStep::class)->orderBy('order');
    }
}
