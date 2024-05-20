<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Register User
    public function register(Request $request) {
        //validate
        $fields = $request -> validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email','unique:users'],
            'password' => ['required', 'min:8','confirmed']
        ]);

        //Register
        $user = User::create($fields);

        //Login
        Auth::login($user);
        //Redirect
        return redirect()->route('home');
    }

    //Login User
    public function login(Request $request) {
        //validate
        $field = $request -> validate([
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required']
        ]);

        //Try to Login the user
        if (Auth::attempt($field, $request->remember)) {
            //return redirect()->route('home');
            return redirect()->intended();
        }
        else {
            return back()->withErrors([
                "failed" => "The email and password that you've entered is incorrect."
            ]);
        }
    }
}
