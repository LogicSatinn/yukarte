<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler as BaseWebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Stringable;

class WebhookHandler extends BaseWebhookHandler
{
    public function pr()
    {
        Telegraph::message('PR')
            ->replyKeyboard(
                ReplyKeyboard::make()->buttons([
                    ReplyButton::make('foo')->requestPoll(),
                    ReplyButton::make('bar')->requestQuiz(),
                    ReplyButton::make('baz')->webApp('https://webapp.dev'),
                ])
            )
        ->send();
    }
}
