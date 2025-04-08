<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 🔹 1. Register Function
    public function register(Request $request)
    {
        // Validate the inputs (name, email, password)
        // -> Make sure email is unique, password is confirmed
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        // Create and save the user with hashed password
        // -> We use Hash::make to store a secure password
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Automatically log the user in
        auth()->login($user);

        // Redirect to a protected page
        return redirect('/dashboard');
    }

    // 🔹 2. Login Function
    public function login(Request $request)
    {
        // Validate the input (email and password)
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to login with the provided credentials
        // -> Auth::attempt checks and logs in if correct
        if (Auth::attempt($credentials)) {
            // Prevent session fixation attack
            $request->session()->regenerate();

            // Redirect to intended page (or default)
            return redirect()->intended('/dashboard');
        }

        // If login fails, return with an error
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // 🔹 3. Logout Function
    public function logout(Request $request)
    {
        // Logs the user out
        Auth::logout();

        // Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page or homepage
        return redirect('/login');
    }

    // Show the registration form
    public function showsignupForm()
    {
        return view('auth.signup');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }


}
