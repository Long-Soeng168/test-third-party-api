<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ======== Testing Third Party Api =========

// Use Gmail Server for sent mail
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloMail;

Route::get('/gmail-test', function () {

    Mail::to('longsoeng096@gmail.com')
        ->send(new HelloMail());

    return 'Mail Sent Successful!';
});


// Use Telegram API for notification
use Illuminate\Support\Facades\Notification;
use App\Notifications\MyTelegramBotNotification;

Route::get('/telegram-test', function () {
    try {
        Notification::route('telegram', config('services.telegram_chat_id'))
            ->notify(new MyTelegramBotNotification());
    } catch (\Exception $e) {
        Log::error('Notification failed: ' . $e->getMessage());
    }
    return 'Notification sent!';
});
