<?php

namespace App\Enums;

use Cerbero\Enum\Concerns\Enumerates;

enum WeightUnit
{
    use Enumerates;

    case Kilograms;
    case Pounds;

    public static function presentable(): array
    {
        return collect([
            ['name' => self::Kilograms->name, 'value' => 'Kilograms (kg)'],
            ['name' => self::Pounds->name, 'value' => 'Pounds (lb)'],
        ])->pluck(
            'value',
            'name'
        )->toArray();
    }
}
