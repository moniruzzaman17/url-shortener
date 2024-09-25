<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UrlShortenerController;

Route::post('/shorten-url', [UrlShortenerController::class, 'shorten']);

