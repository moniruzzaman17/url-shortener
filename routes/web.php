<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\Auth\AuthController;

Route::get('/', [WelcomeController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');