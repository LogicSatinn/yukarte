<?php

namespace App\Livewire;

use App\Enums\MainLiftOptions;
use App\Enums\WeightUnit;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

class Setting extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?Collection $program;

    public ?string $weightUnit;

    public int|float|null $trainingMaxPercentage;

    public ?Collection $oneRepMaxes;

    public function mount(): void
    {
        $this->oneRepMaxes = collect();
        $this->program = collect();

        if (Storage::disk('settings')->exists('program.yaml')) {
            $this->program = collect(Yaml::parseFile(Storage::disk('settings')->path('program.yaml')));
        }

        if (Storage::disk('settings')->exists('one-rep-maxes.yaml')) {
            $this->oneRepMaxes = collect(Yaml::parseFile(Storage::disk('settings')->path('one-rep-maxes.yaml')));
        }

        if (Storage::disk('settings')->exists('configurations.yaml')) {
            $configurations = collect(Yaml::parseFile(Storage::disk('settings')->path('configurations.yaml')));

            $this->weightUnit = $configurations->get('weight_unit');
            $this->trainingMaxPercentage = $configurations->get('training_max_percentage');
        }
    }

    public function updateConfigurationsAction(): Action
    {
        return Action::make('updateConfigurations')
            ->label('Update Configurations')
            ->icon('heroicon-o-cog')
            ->action(function (array $data) {
                $data['training_max_percentage'] = (int) $data['training_max_percentage'];

                $configurationsToBeSaved = Yaml::dump($data);

                Storage::disk('settings')->put('configurations.yaml', $configurationsToBeSaved);

                Notification::make()
                    ->title('Configurations Updated Successfully')
                    ->success()
                    ->send();

                $this->redirect(route('setting'), navigate: true);
            })
            ->form([
                Section::make()
                    ->columns()
                    ->schema([
                        Select::make('weight_unit')
                            ->options(
                                WeightUnit::presentable()
                            )
                            ->required(),

                        TextInput::make('training_max_percentage')
                            ->type('number')
                            ->maxValue(100)
                            ->required(),
                    ])
            ]);
    }

    public function addOrUpdateOneRepMaxesAction(): Action
    {
        return Action::make('addOrUpdateOneRepMaxes')
            ->label('Add/Update One Rep Maxes')
            ->icon('heroicon-o-plus-circle')
            ->action(function (array $data) {
                $data = collect($data)
                    ->map(fn($value) => (float) $value)
                    ->mapWithKeys(function ($value, $key) {
                        $mainLift = str($key)
                            ->replace('_one_rep_max', '')
                            ->replace('_', ' ')
                            ->title()
                            ->toString();

                        return [
                            $mainLift => [
                                'one_rep_max' => $value,
                                'training_max' => BigDecimal::of(value: $value)
                                    ->multipliedBy(
                                        that: BigDecimal::of(value: $this->trainingMaxPercentage)
                                            ->dividedBy(
                                                that: 100,
                                                scale: 1,
                                                roundingMode: RoundingMode::HALF_UP
                                            )
                                    )
                                    ->__toString()
                            ]
                        ];
                    })
                    ->toArray();

                $oneRepMaxesToBeSaved = Yaml::dump($data);

                Storage::disk('settings')->put('one-rep-maxes.yaml', $oneRepMaxesToBeSaved);

                Notification::make()
                    ->title('One Rep Maxes Added Successfully')
                    ->success()
                    ->send();

                $this->redirect(route('setting'), navigate: true);
            })
            ->form([
                Section::make()
                    ->schema([
                        Fieldset::make('Squat')
                            ->columns()
                            ->schema([
                                TextInput::make(str(MainLiftOptions::Squat->value)->snake()->toString().'_'.'one_rep_max')
                                    ->id(MainLiftOptions::Squat->value)
                                    ->numeric()
                                    ->inputMode('decimal')
                            ]),
                        Fieldset::make('Bench Press')
                            ->columns()
                            ->schema([
                                TextInput::make(str(MainLiftOptions::BenchPress->value)->snake()->toString().'_'.'one_rep_max')
                                    ->id(MainLiftOptions::BenchPress->value)
                                    ->numeric()
                                    ->inputMode('decimal')
                            ]),
                        Fieldset::make('Deadlift')
                            ->columns()
                            ->schema([
                                TextInput::make(str(MainLiftOptions::Deadlift->value)->snake()->toString().'_'.'one_rep_max')
                                    ->id(MainLiftOptions::Deadlift->value)
                                    ->numeric()
                                    ->inputMode('decimal')
                            ]),
                        Fieldset::make('Standing Press')
                            ->columns()
                            ->schema([
                                TextInput::make(str(MainLiftOptions::StandingPress->value)->snake()->toString().'_'.'one_rep_max')
                                    ->id(MainLiftOptions::StandingPress->value)
                                    ->numeric()
                                    ->inputMode('decimal')
                            ]),
                    ])
            ]);
    }

    public function render(): View|Application|Factory
    {
        return view('pages.setting');
    }
}
