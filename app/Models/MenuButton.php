<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuButton extends Model
{
    protected $fillable = ['user_id', 'label', 'link', 'is_external', 'order'];

    protected $casts = [
        'is_external' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
