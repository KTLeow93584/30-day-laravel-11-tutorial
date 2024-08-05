<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Step 1: Validate the user input.
        $attribute = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Step 2: Attempt to log the user into the application.
        $isLoggedIn = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Step 3: If the user was found, log them in. (Regenerate the session token/ID)
        // If failed, redirect back to the login page.
        if (!$isLoggedIn) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match our records.'
            ]);
        }
        $request->session()->regenerate();
        return redirect('/jobs');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
