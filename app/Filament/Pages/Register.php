<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegisterPage;

class Register extends BaseRegisterPage
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('username')
                    ->unique(
                        table: 'users',
                        column: 'username'
                    )
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone_number')
                    ->helperText('Please provide a phone number that you use for Telegram. We\'ll never share your phone number with anyone else.')
                    ->tel()
                    ->required(),

                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
