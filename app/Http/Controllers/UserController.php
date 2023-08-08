<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class UserController extends Controller
{
    function signup() {
        return view('signup');
    }

    function register(Request $request) {

        $errors = [];
        $numberOfUsersRegistered = User::count();

        // validate email
        $emailValidation = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        if($emailValidation->fails()){
            $errors['emailError'] = 'This email is already registered! ' . $numberOfUsersRegistered;
        }

        // validate name
        $nameValidation = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users'
        ]);

        if($nameValidation->fails()){
            $errors['usernameError'] = "This username is already taken!";
        }

        if($errors) {
            return response()->json($errors, 400);
        }

        // validate password
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        try {
            $userId = $this -> getUserId($numberOfUsersRegistered);
        } catch (Exception $e) {
            return response()->json(['message' => "Hello World!"]);
        }

        $user = User::create([
            'user_id' => $userId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => "User created Successfully!"], 201);
    }

    function showLoginForm() {
        return view('login');
    }

    function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            // Authentication passed...
            // return response()->json(['message' => "Hello!"]);
            return redirect()->intended('/');
        }

        // Authentication failed...
        return response()->json(['message' => 'Invalid Email or Password!']);

        // // Authentication failed...
        // return back()->withInput()->withErrors(['email' => 'Invalid credentials.']);
    }

    // function logout() {

    // }

    function showResetPassword() {
        return view('resetPassword');
    }


    // 
    function getUserId($number) {
        $digitCount = 8; // Assuming you always want 8 digits
        $userId = str_pad($number, $digitCount, '0', STR_PAD_LEFT);
        return $userId;
    }

    function checkEmailExistance(Request $request) {
        $emailExists = User::where('email', $request -> email) -> exists();
        return response() -> json(['exists' => $emailExists]);
    }

    function resetPassword(Request $request) {
        User::where('email', $request -> email) -> update(['password' => Hash::make($request -> password)]);
        return response() -> json(['message' => 'Password reset successfully!']);
    }
}
