<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\Auth\AuthController;

Route::get('/', [WelcomeController::class, 'index'])->name('index');
Route::post('/shorten-url', [WelcomeController::class, 'shortenUrl'])->name('url.shorten');
Route::get('/{shortCode}', [WelcomeController::class, 'redirectUrl'])->name('url.redirect');
Route::get('/docs/api-documentation', [WelcomeController::class, 'apiDocs'])->name('api.docs');

Route::get('/auth/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/regenerate-url/{id}', [WelcomeController::class, 'regenerate'])->name('url.regenerate');
    Route::delete('/delete-url/{id}', [WelcomeController::class, 'delete'])->name('url.delete');

});

Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');