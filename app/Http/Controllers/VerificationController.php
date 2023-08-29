<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class VerificationController extends Controller
{
    function verifyEmailPage() {
        return view('emails.verifyPage');
    }

    function verifyEmail(Request $request) {
        $userId = $request -> userId;
        $verificationCode = $request -> verificationCode;

        $user = User::find($userId);

        if($user) {
            if ($user -> verification_code === $verificationCode) {
                $user -> email_verified = true;
                $user -> save();

                return response() -> json(['success' => true, 'message' => 'Email verified successfully!']);
            } 
            return response() -> json(['success' => false, 'message' => 'Invalid verification code!']);
        }

        return response() -> json(['success' => false, 'message' => "User not found!"]);
    }

    function getVerificationCode(Request $request) {
        $user = User::find($request -> userId);
        $verificationCode = rand(000000, 999999);
        $user -> verification_code = $verificationCode;
        $user -> save();
        Mail::to($user -> email) -> send(new SendMail($user));
        return response() -> json(['message' => 'An email with a verification code is sent!', 201]);
    }
}
