<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/check-email', [UserController::class, 'checkEmailExistance']);
Route::post('/reset-password', [UserController::class, 'resetPassword']);
Route::post('/verify-email/{user_id}', [VerificationController::class, 'verifyEmail'])
    ->where('user_id', '[0-9]{8}');
Route::post('/get-verification-code', [VerificationController::class, 'getVerificationCode']);