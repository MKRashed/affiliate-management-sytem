<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Promocode extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'affiliate_id',
        'code',
    ];

    // public $timestamps = false;


    public function assignable()
    {
        return $this->morphTo();
    }

    public function assignBy(){
        return $this->belongsTo(Affiliate::class, 'assignable_id', 'id');
    }

    public function providerPromo(){
        return $this->belongsTo(Affiliate::class, 'affiliate_id', 'id');
    }
}
