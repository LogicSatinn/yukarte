<?php

namespace App\Services;

use App\Actions\HydrateProgramData;
use App\Data\TrainingMaxVolumesData;
use App\Models\Day;
use Brick\Math\RoundingMode;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

readonly class ComputeMainLiftsForTheDay
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

        // Grab only the week we need
        $weekSpecifics = collect(app(HydrateProgramData::class)())->get('week_'.$day->week->number);

        // Grab the routine for the day
        $routine = collect(Yaml::parseFile(Storage::disk('settings')->path('routine.yaml')))
            ->get(Carbon::parse($day->date)->format('l'));

        // Match each main lift with its sets
        return collect($routine['main_lifts'])
            ->mapWithKeys(function ($mainLift) use ($weekSpecifics, $cycle, $routine) {
                $mainLiftSets = collect($weekSpecifics)
                    ->map(function ($item) use ($mainLift, $cycle) {
                    return [
                        // When a set is an AMRAP i.e "5+", it's a string. Otherwise, it's hydrated as BigInteger in the HydrateProgramData class
                        'reps' => $item['reps'],
                        'volume' => $item['percentage_based_on_training_max']
                            ->dividedBy(
                                that: 100,
                                scale: 2,
                                roundingMode: RoundingMode::HALF_UP
                            )
                            // Get the training max volumes for the cycle. Use the TrainingMaxVolumesData class to hydrate the data.
                            ->multipliedBy(
                                that: collect(TrainingMaxVolumesData::from($cycle->training_max_volumes)->toArray())
                                    ->sole(fn($value, $key) => str($key)->replace('_', ' ')->title()->toString() === $mainLift)
                            )
                            ->getIntegralPart(),
                    ];
                });

                return [$mainLift => $mainLiftSets];
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
