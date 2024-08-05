<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Step 1: Validate the user input.
        $attributes = request()->validate([
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|string|email|max:254|unique:users',
            'password' => ['required', 'string', 'confirmed', Password::min(8)->max(20)->mixedCase()->symbols()->numbers()],
        ]);

        // Step 3: Create the user.
        $user = User::create($attributes);

        // Step 4: Log the user in.
        Auth::login($user);

        return redirect('/jobs');
    }
}
