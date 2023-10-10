<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Week extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'number',
        'start',
        'end',
        'cycle_id',
        'type',
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
    ];

    public function days(): HasMany
    {
        return $this->hasMany(
            Day::class,
            'week_id',
        );
    }

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }
}
