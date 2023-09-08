<?php

declare(strict_types=1);

namespace App\Livewire\WorkoutRoutine;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

class Index extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?Collection $routine;

    public function mount(): void
    {
        $this->routine = collect();

        if (Storage::disk('settings')->exists('routine.yaml')) {
            $this->routine = collect(Yaml::parseFile(Storage::disk('settings')->path('routine.yaml')));
        }
    }

    public function addWorkoutRoutineAction(): Action
    {
        return Action::make('addWorkoutRoutine')
            ->label('Add Workout Routine')
            ->icon('heroicon-s-plus')
            ->action(fn () => $this->redirect(route('workout-routine.create'), navigate: true));
    }

    public function addWarmUpsAction(): Action
    {
        return Action::make('addOrUpdateWarmUps')
            ->label('Add/Update Warm Ups')
            ->icon('heroicon-s-plus')
            ->action(function (array $data): void {
                dd($data);
            })
            ->form([
                Repeater::make('warm_ups')
                    ->columns()
                    ->columnSpanFull()
                    ->visible(fn (Get $get) => $get('can_add_warm_ups'))
                    ->schema([
                        TextInput::make('warm_up_exercise')
                            ->label('Warm Up Exercise')
                            ->required(),

                        TextInput::make('sets')
                            ->type('number')
                            ->numeric()
                            ->label('Set')
                            ->required(),

                        TextInput::make('reps')
                            ->type('number')
                            ->numeric()
                            ->label('Rep')
                            ->required(),

                        TextInput::make('percentage_based_on_training_max')
                            ->type('number')
                            ->label('Percentage Based on Training Max')
                            ->numeric()
                            ->nullable(),
                    ])
                    ->addActionLabel('Add Warm Up')
                    ->label('Warm Up(s) for this day'),
            ]);
    }

    public function render(): View
    {
        return view('pages.workout-routine.index');
    }
}
