<?php

namespace App\Services;

use App\Actions\HydrateProgramData;
use App\Data\TrainingMaxVolumesData;
use App\Models\Day;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

readonly class ComputeSecondaryLiftsForTheDay
{
    /**
     * @param  Day  $day
     * @return Collection
     * @throws Exception
     */
    public function __invoke(Day $day): Collection
    {
        $this->checkIfFileExists();

        $cycle = $day->week->cycle;

        // Grab the routine for the day
        $routine = collect(Yaml::parseFile(Storage::disk('settings')->path('routine.yaml')))
            ->get(Carbon::parse($day->date)->format('l'));

        // Match each secondary lift with its sets
        return collect($routine['secondary_lifts'])
            ->mapWithKeys(function ($secondaryLiftSpecifics, $lift) use ($cycle) {
                return [
                    $lift => [
                        'sets' => $secondaryLiftSpecifics['sets'],
                        'reps' => $secondaryLiftSpecifics['reps'],
                        'volume' => BigDecimal::of($secondaryLiftSpecifics['percentage_based_on_training_max'])
                            ->dividedBy(
                                that: 100,
                                scale: 2,
                                roundingMode: RoundingMode::HALF_UP
                            )
                            // Get the training max volumes for the cycle. Use the TrainingMaxVolumesData class to hydrate the data.
                            ->multipliedBy(
                                that: collect(TrainingMaxVolumesData::from($cycle->training_max_volumes)->toArray())
                                    ->sole(fn($value, $key) => str($key)->replace('_', ' ')->title()->toString() === $lift)
                            )
                            ->getIntegralPart(),
                    ]
                ];
            });
    }

    /**
     * @return void
     * @throws Exception
     */
    protected function checkIfFileExists(): void
    {
        if (!Storage::disk('settings')->exists('program.yaml')) {
            throw new Exception('Program file does not exist.');
        }
    }
}
