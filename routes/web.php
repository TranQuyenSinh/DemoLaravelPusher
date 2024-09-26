<?php

use App\Events\NewMessage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/messages', function () {
    $messages = session()->get('messages', []);
    $messages[] = request('message');
    session()->put('messages', $messages);
    event(new NewMessage(request('message')));
});

Route::get('/messages', function () {
    $messages =  session()->get('messages', []);
    foreach ($messages as $message) {
        echo '<p>' . $message . '</p>';
    }
});

Route::get('clear-message', function () {
    session()->forget('messages');
    event(new NewMessage(request('message')));
});
