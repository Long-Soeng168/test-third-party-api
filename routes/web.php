<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloMail;

Route::get('/test-mail', function () {

    Mail::to('rabunthoeun7777@gmail.com')
        ->send(new HelloMail());

    return 'Mail Sent Successful!';
});

Route::get('/test_send_message', function () {
    $botToken = '7635194878:AAF7_isydhFtD1P1DTseKVDpN8hAMgOMArc';
    $chatId = '-1670274507';
    $message = "Hello from Laravel! This is a test message to your Telegram group.";

    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

    // Log URL and parameters
    \Log::info("Sending request to Telegram API with URL: $url and Chat ID: $chatId");

    $response = Http::post($url, [
        'chat_id' => $chatId,
        'text' => $message,
    ]);

    if ($response->successful()) {
        return "Message sent to Telegram!";
    } else {
        \Log::error("Telegram API Error: " . $response->status() . " - " . $response->body());
        return "Failed to send message: " . $response->body();
    }
});


