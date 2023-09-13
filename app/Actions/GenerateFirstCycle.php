<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\TrainingMaxVolumesData;
use App\Models\Cycle;
use App\Models\Week;
use Brick\Math\BigDecimal;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

final readonly class GenerateFirstCycle
{
    public function __construct(
        private FormatConfigurationData $formatConfigurationData,
        private GenerateDaysInACycle $generateDaysInACycle,
    ) {
    }

    /**
     * @return void
     * @throws Exception
     */
    public function __invoke(): void
    {
        $this->checkIfRequiredFilesExist();

        $configurationData = ($this->formatConfigurationData)();

        $trainingMaxVolumes = collect(Yaml::parseFile(Storage::disk('settings')->path('one-rep-maxes.yaml')))
            ->mapWithKeys(
                fn ($value, $key) => [str($key)->camel()->toString() => BigDecimal::of($value)->multipliedBy($configurationData->trainingMaxPercentage)]
            )
            ->toArray();

        $cycle = Cycle::create([
            'start' => now()->toDate(),
            'end' => now()->addDays(30)->toDate(),
            'training_max_volumes' => TrainingMaxVolumesData::from($trainingMaxVolumes)->toArray(),
        ]);

        $daysInAMonth = ($this->generateDaysInACycle)(startDate: $cycle->start);

        $daysInAMonth
            ->chunk(3)
            ->map(function ($chunk, $index) use ($cycle): void {
                $week = Week::create([
                    'number' => $index + 1,
                    'start' => Carbon::parse($chunk->first())->toDate(),
                    'end' => Carbon::parse($chunk->last())->toDate(),
                    'cycle_id' => $cycle->id,
                ]);

                $week->days()->createMany(
                    $chunk->map(fn ($day) => ['date' => Carbon::parse($day)->toDate()])->toArray()
                );
            });
    }

    /**
     * @return void
     * @throws Exception
     */
    private function checkIfRequiredFilesExist(): void
    {
        if ( ! Storage::disk('settings')->exists('configurations.yaml')) {
            throw new Exception('Configurations file is not found.');
        }

        if ( ! Storage::disk('settings')->exists('program.yaml')) {
            throw new Exception('Program file is not found.');
        }

        if ( ! Storage::disk('settings')->exists('routine.yaml')) {
            throw new Exception('Routine file is not found.');
        }

        if ( ! Storage::disk('settings')->exists('one-rep-maxes.yaml')) {
            throw new Exception('One rep maxes file is not found.');
        }
    }
}
