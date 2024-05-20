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
}
