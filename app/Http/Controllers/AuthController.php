<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Signup
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); 

        // return redirect()->route('dashboard'); 
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {  
            $request->session()->regenerate(); 
            // return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'            => 'nullable|string|max:255',
        'email'           => 'nullable|email|unique:users,email,' . $user->id,
        'bio'             => 'nullable|string|max:1000',
        'password'        => 'nullable|string|min:6|confirmed',
        'profile_image'   => 'nullable|image|max:2048',
        'facebook_link'   => 'nullable|url',
        'instagram_link'  => 'nullable|url',
        'twitter_link'    => 'nullable|url',
        'youtube_link'    => 'nullable|url',
        'tiktok_link'     => 'nullable|url',
    ]);

    if ($request->hasFile('profile_image')) {
        $filename = time() . '_' . $request->file('profile_image')->getClientOriginalName();
        $path = $request->file('profile_image')->storeAs('profile_images', $filename, 'public');
        $user->profile_image = $path;
    }

    $user->name           = $request->name           ?? $user->name;
    $user->email          = $request->email          ?? $user->email;
    $user->bio            = $request->bio            ?? $user->bio;
    $user->facebook_link  = $request->facebook_link  ?? $user->facebook_link;
    $user->instagram_link = $request->instagram_link ?? $user->instagram_link;
    $user->twitter_link   = $request->twitter_link   ?? $user->twitter_link;
    $user->youtube_link   = $request->youtube_link   ?? $user->youtube_link;
    $user->tiktok_link    = $request->tiktok_link    ?? $user->tiktok_link;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }   

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}


}
