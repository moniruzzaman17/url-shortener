<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\Auth\AuthController;

Route::get('/', [WelcomeController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');