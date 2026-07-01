<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'fname',
        'lname',
        'email_id',
        'mobile_number',
        'password',

        'organisation_name',
        'website_name',
        'domain',
        'website_type',
        'web_descroption',
        'location',
        'target_audience',

        'facebook',
        'instagram',
        'twitter',
        'linkedIn',
        'youtube',
        'whatsapp',

        'logo',
        'primary_color',
        'tagline',
        'notes',

        'terms',
    ];

    protected $casts = [
        'terms' => 'boolean',
        'password' => 'hashed',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function menuButtons()
    {
        return $this->hasMany(MenuButton::class);
    }

    public function menuSetting()
    {
        return $this->hasOne(MenuSetting::class);
    }

    public function ribbion()
    {
        return $this->hasOne(Ribbion::class);
    }

    public function ribbions()
    {
        return $this->hasMany(Ribbion::class)->orderBy('slot');
    }

    public function landingSection()
    {
        return $this->hasOne(LandingSection::class);
    }
}
