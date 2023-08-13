<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Croptype extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'crop_type'
    ];

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];
}
