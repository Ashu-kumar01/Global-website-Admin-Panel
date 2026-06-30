<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSetting extends Model
{
    protected $fillable = ['user_id', 'logo_position', 'logo_size'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
