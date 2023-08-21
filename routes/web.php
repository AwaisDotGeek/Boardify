<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppController;

Route::get('/', function () {
    return view('home');
});

// get :: UserController
Route::get('/signup', [UserController::class, 'signup']);
Route::get('/verify-email', [UserController::class, 'verifyEmailPage']);

Route::get('/login', [UserController::class, 'showLoginForm']);

Route::get('/reset-password', [UserController::class, 'showResetPassword']);

// get :: App Controller
Route::get('/boardify-home', [AppController::class, 'boardifyHome']);
Route::get('/user-profile', [AppController::class, 'userProfile']);

// post

Route::post('/login', [UserController::class, 'login']);