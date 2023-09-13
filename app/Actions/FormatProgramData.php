<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\ProgramData;
use App\Data\SetData;
use App\Data\WeekData;
use Brick\Math\BigDecimal;
use Brick\Math\BigNumber;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

final class FormatProgramData
{
    /**
     * @return ProgramData
     * @throws Exception
     */
    public function __invoke(): ProgramData
    {
        $this->checkIfFileExists();

        [$weeks, $sets] = Arr::divide(Yaml::parseFile(Storage::disk('settings')->path('program.yaml')));

        $program = collect($weeks)
            ->mapWithKeys(
                fn ($week, $index) => [
                    $week => WeekData::from(
                        collect($sets[$index])
                            ->mapWithKeys(
                                fn ($setValue, $setName) => [
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

        return ProgramData::from($program);
    }

    /**
     * @return void
     * @throws Exception
     */
    private function checkIfFileExists(): void
    {
        if ( ! Storage::disk('settings')->exists('program.yaml')) {
            throw new Exception('Program file does not exist.');
        }
    }
}
