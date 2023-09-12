<?php

namespace App\Data;

use Brick\Math\BigDecimal;
use Brick\Math\BigNumber;
use Spatie\LaravelData\Data;

class SetData extends Data
{
public function __construct(
    public BigDecimal $percentage_based_on_training_max,
    public BigNumber|string $reps,
)
{
}
}
