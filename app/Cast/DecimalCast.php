<?php

namespace App\Cast;

use Brick\Math\BigDecimal;
use Brick\Math\Exception\MathException;
use InvalidArgumentException;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class DecimalCast implements Cast
{
    /**
     * @throws MathException
     */
    public function cast(DataProperty $property, mixed $value, array $context): BigDecimal
    {
        if ($value instanceof BigDecimal) {
            return $value;
        }

        if (is_string($value)) {
            return BigDecimal::of($value);
        }

        if (is_int($value)) {
            return BigDecimal::of($value);
        }

        if (is_float($value)) {
            return BigDecimal::of($value);
        }

        throw new InvalidArgumentException("Cannot cast value to BigDecimal");
    }
}
