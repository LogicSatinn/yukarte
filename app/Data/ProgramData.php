<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ProgramData extends Data
{
public function __construct(
    public WeekData $week_1,
    public WeekData $week_2,
    public WeekData $week_3,
    public WeekData $week_4,
)
{
}
}
