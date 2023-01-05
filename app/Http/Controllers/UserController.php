<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginShow()
    {
        if (!Auth::check()) {
            return view('login');
        } else {
            return redirect('home');
        }
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('home');
        }

        $formFields = $request->only(['username', 'password']);

        if (Auth::attempt($formFields)) {
            return redirect('home');
        }
        return redirect('login')->withErrors([
            'loginError' => 'Username or password are incorrect'
        ]);
    }

    public function registrationShow()
    {
        if (!Auth::check()) {
            return view('registration');
        } else {
            return redirect('home');
        }
    }
    public function registration(Request $request)
    {
        if (Auth::check()) {
            return redirect('home');
        }

        $validatedFields = $request->validate([
            'username' => 'required|min:3|max:24|alpha_num|unique:users,username',
            'password' => 'required|confirmed|min:5|max:255|alpha_num',
            'password_confirmation' => 'required'
        ]);

        $user = User::create($validatedFields);

        if ($user) {
            Auth::login($user);
            return redirect('home');
        } else {
            return redirect('registration')->withErrors([
                'registrationError' => 'Unexpected registration error.'
            ]);
        }
    }
}
