<?php

namespace App\Actions;

use App\Data\ConfigurationData;
use App\Data\ProgramData;
use App\Data\SetData;
use App\Data\TrainingMaxVolumesData;
use App\Data\WeekData;
use App\Models\Cycle;
use App\Models\Week;
use Brick\Math\BigDecimal;
use Brick\Math\BigNumber;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;
use When\When;

final class GenerateFirstCycle
{
    /**
     * @return void
     * @throws Exception
     */
    public function __invoke(): void
    {
        $this->checkIfRequiredFilesExist();

        $configurations = Yaml::parseFile(Storage::disk('settings')->path('configurations.yaml'));

        $configurationData = ConfigurationData::from([
            'weightUnit' => $configurations['weight_unit'],
            'trainingMaxPercentage' => BigDecimal::of($configurations['training_max_percentage'])
                ->dividedBy(
                    that: 100,
                    scale: 1,
                ),
        ]);

        [$weeks, $sets] = Arr::divide(Yaml::parseFile(Storage::disk('settings')->path('program.yaml')));

        $program = collect($weeks)
            ->mapWithKeys(fn($week, $index) => [
                $week => WeekData::from(
                    collect($sets[$index])
                        ->mapWithKeys(
                            fn($setValue, $setName) => [
                                $setName => SetData::from([
                                    'percentage_based_on_training_max' => BigDecimal::of($setValue['percentage_based_on_training_max']),
                                    'reps' => str($setValue['reps'])->contains('+') ? $setValue['reps'] : BigNumber::of($setValue['reps']),
                                ]),
                            ]
                        )
                        ->toArray()
                ),
            ]
            )
            ->toArray();

        $programData = ProgramData::from($program);

        $trainingMaxVolumes = collect(Yaml::parseFile(Storage::disk('settings')->path('one-rep-maxes.yaml')))
            ->mapWithKeys(fn(
                $value,
                $key
            ) => [str($key)->camel()->toString() => BigDecimal::of($value)->multipliedBy($configurationData->trainingMaxPercentage)])
            ->toArray();

        $cycle = Cycle::create([
            'start' => now()->toDate(),
            'end' => now()->addDays(30)->toDate(),
            'training_max_volumes' => TrainingMaxVolumesData::from($trainingMaxVolumes)->toArray(),
        ]);

        $days = collect(Yaml::parseFile(Storage::disk('settings')->path('routine.yaml')))
            ->keys();

        $workoutDaysInAMonthCount = $days->count() * 4;

        $dayNameShortened = $days
            ->map(fn($day) => str($day)->substr(0, 2)->upper()->toString())
            ->implode(',');

        $when = app(When::class);

        $when->startDate(now()->toDate())
            ->rrule("FREQ=DAILY;BYDAY={$dayNameShortened};COUNT={$workoutDaysInAMonthCount}")
            ->generateOccurrences();

        collect($when->occurrences)
            ->chunk(3)
            ->map(function ($chunk, $index) use ($cycle) {
                $week = Week::create([
                    'number' => $index + 1,
                    'start' => Carbon::parse($chunk->first())->toDate(),
                    'end' => Carbon::parse($chunk->last())->toDate(),
                    'cycle_id' => $cycle->id,
                ]);

                $week->days()->createMany(
                    $chunk->map(fn($day) => ['date' => Carbon::parse($day)->toDate()])->toArray()
                );
            });
    }

    /**
     * @return void
     * @throws Exception
     */
    private function checkIfRequiredFilesExist(): void
    {
        if (!Storage::disk('settings')->exists('configurations.yaml')) {
            throw new Exception('Configurations file is not found.');
        }

        if (!Storage::disk('settings')->exists('program.yaml')) {
            throw new Exception('Program file is not found.');
        }

        if (!Storage::disk('settings')->exists('routine.yaml')) {
            throw new Exception('Routine file is not found.');
        }

        if (!Storage::disk('settings')->exists('one-rep-maxes.yaml')) {
            throw new Exception('One rep maxes file is not found.');
        }
    }
}
