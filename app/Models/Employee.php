<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'employee_id',
        'name',
        'email'
    ];

    // Set UUID keytype to 'string
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];
}
