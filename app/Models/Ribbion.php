<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ribbion extends Model
{
    protected $fillable = [
        'user_id',
        'slot',
        'backgroundColor',
        'textColor',
        'fontFamily',
        'fontSize',
        'fontWeight',
        'ribbonHeight',
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
        'slot' => 'integer',
        'fontSize' => 'integer',
        'ribbonHeight' => 'integer',
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
