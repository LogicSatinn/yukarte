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
    public function start(): void
    {
        $this->chat
            ->markdown("No backing down now, MF. *Let's get to work.*")
            ->send();
    }
}
