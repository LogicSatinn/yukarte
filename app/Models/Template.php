<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'day_of_week',
        'main_lifts',
        'secondary_lifts',
        'workout',
    ];

    protected $casts = [
        'main_lifts' => 'array',
        'secondary_lifts' => 'array',
        'workout' => 'array',
    ];
}
