<?php

namespace App\Enums;

enum WeightUnit
{
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
