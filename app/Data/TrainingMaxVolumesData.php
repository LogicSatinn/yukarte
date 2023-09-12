<?php

namespace App\Data;

use Brick\Math\BigDecimal;
use Spatie\LaravelData\Data;

class TrainingMaxVolumesData extends Data
{
public function __construct(
    public BigDecimal $squat,
    public BigDecimal $benchPress,
    public BigDecimal $deadlift,
    public BigDecimal $standingPress,
)
{
}
}
