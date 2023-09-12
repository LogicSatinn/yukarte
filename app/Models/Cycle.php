<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'start',
        'end',
        'training_max_volumes',
        'notes'
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'training_max_volumes' => 'array',
    ];

    public function weeks(): HasMany
    {
        return $this->hasMany(
            Week::class,
            'cycle_id',
        );
    }
}
