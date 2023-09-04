<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes, HasUlids;

    protected $fillable = [
        'one_rep_max',
        'weight_unit',
        'training_max_percentage',
        'main_lift_options',
        'template',
    ];

    protected $casts = [
        'main_lift_options' => 'array',
        'template' => 'array',
    ];

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
        );
    }
}
