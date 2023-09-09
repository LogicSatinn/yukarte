<?php

declare(strict_types=1);

namespace App\Livewire\WorkoutRoutine;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @property Form $form
 */
class Create extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        FileUpload::make('workout-routine')
                            ->label('Upload your Routine')
                            ->required()
                            ->disk('settings')
                            ->acceptedFileTypes(['application/x-yaml']),
                    ])
            ]);
    }

    public function saveRoutine(): void
    {
        dd($this->data);
    }

    public function render(): View
    {
        return view('pages.workout-routine.create');
    }
}
