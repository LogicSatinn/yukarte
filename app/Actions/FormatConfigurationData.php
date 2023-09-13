<?php

namespace App\Actions;

use App\Data\ConfigurationData;
use Brick\Math\BigDecimal;
use Brick\Math\Exception\MathException;
use Exception;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

final class FormatConfigurationData
{
    /**
     * @return ConfigurationData
     * @throws MathException
     * @throws Exception
     */
    public function __invoke(): ConfigurationData
    {
        $this->checkIfFileExists();

        $configurations = Yaml::parseFile(Storage::disk('settings')->path('configurations.yaml'));

        return ConfigurationData::from([
            'weightUnit' => $configurations['weight_unit'],
            'trainingMaxPercentage' => BigDecimal::of($configurations['training_max_percentage'])
                ->dividedBy(
                    that: 100,
                    scale: 1,
                ),
        ]);
    }

    /**
     * @return void
     * @throws Exception
     */
    private function checkIfFileExists(): void
    {
        if (!Storage::disk('settings')->exists('configurations.yaml')) {
            throw new Exception('Configurations file does not exist.');
        }
    }
}
