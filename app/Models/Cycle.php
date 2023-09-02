<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'training_max',
    ];

    public function weeks(): HasMany
    {
        return $this->hasMany(
            Week::class,
            'cycle_id',
        );
    }
}
