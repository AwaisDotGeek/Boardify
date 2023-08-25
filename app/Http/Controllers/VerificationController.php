<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    function verifyEmailPage() {
        return view('emails.verifyPage');
    }

    function verifyEmail(Request $request) {
        $userId = $request -> userId;
        $verificationCode = $request -> verificationCode;

        $user = User::find($userId);

        if(!$user) {
            return response() -> json(['success' => false, 'message' => "User not found!"]);
        }

        if ($user -> verification_code === $verificationCode) {
            $user -> email_verified = true;
            $user -> save();

            return response() -> json(['success' => true, 'message' => 'Email verified successfully!']);
        } else {
            return response() -> json(['success' => false, 'message' => 'Invalid verification code!']);
        }
    }
}
