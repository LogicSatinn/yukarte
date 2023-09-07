<?php

namespace App\Livewire;

use App\Enums\MainLiftOptions;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

class WorkoutRoutine extends Component implements HasActions, HasForms
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
            ->action(function (array $data) {
                dd($data);
            })
            ->form([
                Repeater::make('days')
                    ->columns()
                    ->schema([
                        Select::make('day')
                            ->options([
                                'Sunday',
                                'Monday',
                                'Tuesday',
                                'Wednesday',
                                'Thursday',
                                'Friday',
                                'Saturday',
                            ])
                            ->label('Day')
                            ->required(),

                        Toggle::make('can_add_warm_ups')
                            ->inline(false)
                            ->dehydrated(false)
                            ->live()
                            ->label('Add Warm Ups'),

                        Repeater::make('warm_ups')
                            ->columns()
                            ->columnSpanFull()
                            ->visible(fn(Get $get) => $get('can_add_warm_ups'))
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

                        Repeater::make('main_lifts')
                            ->columns()
                            ->columnSpanFull()
                            ->schema([
                                Select::make('main_lift')
                                    ->label('Choose Main Lift')
                                    ->required()
                                    ->options(MainLiftOptions::pluck(
                                        fn(MainLiftOptions $mainLiftOptions) => $mainLiftOptions->value,
                                        fn(MainLiftOptions $mainLiftOptions) => $mainLiftOptions->value,
                                    )),
                            ])
                            ->addActionLabel('Add Main Lift')
                            ->label('Choose Main Lift(s) for this day'),

                        Repeater::make('secondary_lifts')
                            ->columns()
                            ->columnSpanFull()
                            ->schema([
                                Select::make('secondary_lift')
                                    ->options(MainLiftOptions::pluck(
                                        fn(MainLiftOptions $mainLiftOptions) => $mainLiftOptions->value,
                                        fn(MainLiftOptions $mainLiftOptions) => $mainLiftOptions->value,
                                    ))
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
                                    ->required(),
                            ])
                            ->addActionLabel('Add Secondary Lift')
                            ->label('Secondary Lift(s) for this day'),
                    ])
                    ->orderColumn()
                    ->label('Days')
                    ->addActionLabel('Add Day')
            ]);
    }

    public function render(): View
    {
        return view('pages.workout-routine');
    }
}
