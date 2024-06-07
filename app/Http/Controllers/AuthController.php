<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
            'password' => ['required', 'min:8', 'max:8','confirmed']
        ]);

        //Register
        $user = User::create($fields);

        //Login
        Auth::login($user);

        //Dispatching Registered event
        //event(new Registered($user));

        //Redirect
        return redirect()->route('dashboard');
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
            return redirect()->intended('dashboard');
        }
        else {
            return back()->withErrors([
                "failed" => "The email and password that you've entered is incorrect."
            ]);
        }
    }

    //Logout User
    public function logout(Request $request) {
        //Logout the user
        Auth::logout();

        //Invalidate user's session
        $request->session()->invalidate();

        //Regenerate csrf token
        $request->session()->regenerateToken();

        //Redirect to home
        return redirect()->route('posts.index');
    }
}
