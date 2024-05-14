<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
       return view("auth.register");
    }

    public function store_register(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = new User();
        $user->password = Hash::make($request->password);
        $user->save();

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function login()
    {
        if(auth()->check()){
            return redirect()->route('home');
        }
        return view('auth.login');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([ 
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->withErrors('Email or password is wrong');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->withSuccess('You have logged out successfully!');;
    }
}
