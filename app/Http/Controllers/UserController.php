<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }

        $formFields = $request->only(['username', 'password']);

        if (Auth::attempt($formFields)) {
            return redirect(route('home'));
        }
    }

    public function registration(Request $request)
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }

        $validatedFields = $request->validate([
            'username' => 'required|min:3|max:24|alpha_num',
            'password' => 'required|confirmed|min:5|max:255|alpha_num',
            'password_confirmation' => 'required'
        ]);

        $user = User::create($validatedFields);

        if ($user) {
            Auth::login($user);
            return redirect(route('home'));
        }
    }
}
