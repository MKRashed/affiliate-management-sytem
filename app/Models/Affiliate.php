<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Affiliate extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'affiliate';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function promocodes()
    {
        return $this->morphMany(Promocode::class, 'assignable');
    }

    public function commitions()
    {
        return $this->morphMany(Commition::class, 'commitionable');
    }

}
