<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('index');