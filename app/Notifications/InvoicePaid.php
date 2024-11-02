<?php

use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    public function via($notifiable)
    {
        return ["telegram"];
    }

    public function toTelegram($notifiable)
    {
        return TelegramContact::create()
                ->to(-1670274507) // Optional
                ->firstName('John')
                ->lastName('Doe') // Optional
                ->phoneNumber('00000000');
    }
}
