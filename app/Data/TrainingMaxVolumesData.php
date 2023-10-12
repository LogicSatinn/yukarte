<?php

declare(strict_types=1);

namespace App\Data;

use App\Cast\DecimalCast;
use Brick\Math\BigDecimal;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TrainingMaxVolumesData extends Data
{
    public function __construct(
        #[WithCast(DecimalCast::class)]
        public BigDecimal $squat,
        #[WithCast(DecimalCast::class)]
        public BigDecimal $benchPress,
        #[WithCast(DecimalCast::class)]
        public BigDecimal $deadlift,
        #[WithCast(DecimalCast::class)]
        public BigDecimal $standingPress,
    ) {
    }
}
