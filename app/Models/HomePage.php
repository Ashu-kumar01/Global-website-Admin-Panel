<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'last_saved_at',
        'published_at',
    ];

    protected $casts = [
        'last_saved_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sections()
    {
        return $this->hasMany(HomePageSection::class)->orderBy('priority');
    }
}
