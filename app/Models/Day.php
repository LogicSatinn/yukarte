<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Day extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'assistance_work',
        'personal_record',
        'week_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'assistance_work' => 'array',
        'personal_record' => 'array',
    ];
}
