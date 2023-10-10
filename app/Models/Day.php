<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Day extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'assistance_work',
        'personal_record',
        'week_id',
    ];

    protected $casts = [
        'date' => 'date',
        'assistance_work' => 'array',
        'personal_record' => 'array',
    ];

    public function week(): BelongsTo
    {
        return $this->belongsTo(Week::class);
    }
}
