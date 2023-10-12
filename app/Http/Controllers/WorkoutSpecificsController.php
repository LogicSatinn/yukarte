<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Services\ComputeMainLiftsForTheDay;
use App\Services\ComputeSecondaryLiftsForTheDay;
use App\Services\Inspiring;
use Inertia\Inertia;
use Inertia\Response;

class WorkoutSpecificsController extends Controller
{
    public function __invoke(Day $day): Response
    {
        $mainLiftsForTheDay = app(ComputeMainLiftsForTheDay::class)(day: $day);
        $secondaryLiftsForTheDay = app(ComputeSecondaryLiftsForTheDay::class)(day: $day);

        return Inertia::render(
            component: 'WorkoutSpecifics/Index',
            props: [
                'quote' => Inspiring::quote(),
                'mainLiftsForTheDay' => $mainLiftsForTheDay,
                'secondaryLiftsForTheDay' => $secondaryLiftsForTheDay,
            ]
        );
    }
}
