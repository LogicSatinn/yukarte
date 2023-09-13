<?php

namespace App\Actions;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;
use When\InvalidStartDate;
use When\When;

final class GenerateDaysInACycle
{
    /**
     * @param  Carbon  $startDate
     * @return Collection
     * @throws InvalidStartDate
     * @throws Exception
     */
    public function __invoke(Carbon $startDate): Collection
    {
        $this->checkIfFileExists();

        $days = collect(Yaml::parseFile(Storage::disk('settings')->path('routine.yaml')))
            ->keys();

        $workoutDaysInAMonthCount = $days->count() * 4; // 4 weeks in a month

        $dayNameShortened = $days
            ->map(fn($day) => str($day)->substr(0, 2)->upper()->toString())
            ->implode(',');

        $when = app(When::class);

        $when->startDate($startDate)
            ->rrule("FREQ=DAILY;BYDAY={$dayNameShortened};COUNT={$workoutDaysInAMonthCount}")
            ->generateOccurrences();

        return collect($when->occurrences);
    }

    /**
     * @return void
     * @throws Exception
     */
    private function checkIfFileExists(): void
    {
        if (!Storage::disk('settings')->exists('routine.yaml')) {
            throw new Exception('Routine file does not exist.');
        }
    }
}
