<?php

namespace App\Actions;

use App\Models\Day;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

final class ComputeWorkoutSpecifics
{
    public function __invoke(): void
    {
        $day = Day::query()
            ->with('week.cycle')
            ->where('date', now()->addDay()->toDateString())
            ->firstOrFail();

        $response = Telegraph::message('Your next workout is ready.')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('View Workout')->webApp(route('workout-specifics', $day)),
                ])
            )
            ->send();

        if ($response->failed()) {
            throw new BadRequestException($response->body());
        }
    }
}
