<?php

namespace App\Actions;

use App\Models\Cycle;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;

final class GenerateNewCycle
{
    public function __invoke(): void
    {
        $configurations = Yaml::parseFile(Storage::disk('settings')->path('configurations.yaml'));
        $program = collect(Yaml::parseFile(Storage::disk('settings')->path('program.yaml')));

        $cycle = Cycle::create([
            'start' => now(),
            'end' => now()->addDays(30),
            'training_max' => $configurations['training_max'],
        ]);

        $program->each(function ($week) use ($cycle) {
            $cycle->weeks()->create([
                'week_number' => $week['week_number'],
                'days' => $week['days'],
            ]);
        });
    }
}
