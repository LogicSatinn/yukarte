<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class WeekData extends Data
{
public function __construct(
    public SetData $set_1,
    public SetData $set_2,
    public SetData $set_3,
)
{
}
}
