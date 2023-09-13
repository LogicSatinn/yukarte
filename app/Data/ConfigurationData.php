<?php

declare(strict_types=1);

namespace App\Data;

use Brick\Math\BigDecimal;
use Spatie\LaravelData\Data;

class ConfigurationData extends Data
{
    public function __construct(
        public string $weightUnit,
        public BigDecimal $trainingMaxPercentage,
    ) {
    }
}
