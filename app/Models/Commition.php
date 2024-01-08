<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount'
    ];

    public function commitionable()
    {
        return $this->morphTo();
    }
}
