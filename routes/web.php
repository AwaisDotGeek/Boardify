<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\VerificationController;

Route::get('/', function () {
    return view('home');
});

// get :: UserController
Route::get('/signup', [UserController::class, 'signup']);
Route::get('/verify-email', [VerificationController::class, 'verifyEmailPage']) -> name('verifyPage');

Route::get('/login', [UserController::class, 'showLoginForm']);

Route::get('/reset-password', [UserController::class, 'showResetPassword']);

// get :: App Controller
Route::get('/boardify-home/{user_id}', [AppController::class, 'boardifyHome'])
    ->where('user_id', '[0-9]{8}');
Route::get('/user-profile', [AppController::class, 'userProfile']);

// post

Route::post('/login', [UserController::class, 'login']);