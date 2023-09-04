<?php

namespace App\Http\Livewire;

use App\Enums\WeightUnit;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

/** @property Form $form */
class Setting extends Component implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    public ?array $data = [];

    public ?Collection $routineTemplate;

    public function mount(): void
    {
        $this->form->fill();

        $this->routineTemplate = collect(Yaml::parseFile(storage_path('routine-template.yaml')));
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Imperative Settings')
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

    public function render(): View|Application|Factory
    {
        return view('pages.setting');
    }
}
