<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(64)
        ]);

        Auth::login($user);

        return redirect( route('books.index') );
    }

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:100|min:6',
        ]);

        if( ! Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect( route('auth.login') );
        }

        return redirect( route('books.index') );
    }


    public function logout()
    {
        Auth::logout();

        return redirect( route('auth.login') );
    }
}
