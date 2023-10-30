<?php

namespace App\Http\Controllers;

use App\candidat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
    
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function register(Request $request)
{
    // Validate the registration request
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:candidat',
        'password' => 'required|confirmed', // Requires a password_confirmation field
    ]);

    // Create a new Candidat
    candidat::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => md5($request->input('password')),
        
    ]);

    // Redirect to the login page or another page after successful registration
    return redirect('/login')->with('success', 'Registration successful. You can now log in.');
}

}
