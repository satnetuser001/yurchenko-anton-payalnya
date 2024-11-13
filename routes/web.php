<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//because functionality of / URL do user.index make a redirection
Route::get('/', function () {
    return redirect()->route('user.index');
})->name('home');

//user CRUD routes
Route::resource('user', UserController::class);

//SMTP test
Route::get('/test-email', function () {
    \Illuminate\Support\Facades\Mail::raw('Тестовий лист!', function ($message) {
        $message->to('satnetuser001@gmail.com')
            ->subject('Тестування пошти');
    });
    return 'Лист відправлений!';
});
