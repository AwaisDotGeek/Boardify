<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

// get

Route::get('/signup', [UserController::class, 'signup']);

Route::get('/login', [UserController::class, 'showLoginForm']);

Route::get('/reset-password', [UserController::class, 'showResetPassword']);

// post

Route::post('/login', [UserController::class, 'login']);