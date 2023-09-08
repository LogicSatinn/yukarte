<?php

declare(strict_types=1);

namespace App\Enums;

use Cerbero\Enum\Concerns\Enumerates;

enum MainLiftOptions: string
{
    use Enumerates;

    case Squat = 'Squat';
    case BenchPress = 'Bench Press';
    case Deadlift = 'Deadlift';
    case StandingPress = 'Standing Press';
}
