<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        return view('frontend.welcome');
    }
    
    public function register() {
        return view('frontend.register');
    }
}
