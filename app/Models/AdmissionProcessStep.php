<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionProcessStep extends Model
{
    protected $fillable = [
        'admission_process_section_id',
        'order',
        'icon',
        'heading',
        'subheading',
    ];

    public function section()
    {
        return $this->belongsTo(AdmissionProcessSection::class, 'admission_process_section_id');
    }
}
