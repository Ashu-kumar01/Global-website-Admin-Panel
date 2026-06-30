<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ribbion extends Model
{
    protected $fillable = [
        'user_id',
        'backgroundColor',
        'textColor',
        'ribbonPosition',
        'position',
        'ribbonCloseBtnRadio',
        'ribbonAnimation',
        'sliderSpeed',
        'status',
    ];

    protected $casts = [
        'ribbonCloseBtnRadio' => 'boolean',
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notices()
    {
        return $this->hasMany(RibbonNotice::class);
    }
}
