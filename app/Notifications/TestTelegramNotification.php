<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class TestTelegramNotification extends Notification
{
    public function via()
    {
        return ['telegram'];
    }

    public function toTelegram()
    {
        return TelegramMessage::create()
            ->to(-1670274507) // Send to the chat ID from .env
            ->content("Hello from Laravel! This is a test message to your Telegram group.")
            ->button('Visit Laravel', 'https://laravel.com'); // Optional button
    }
}
