<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserSubscribed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

        //Dispatching Registered event
        event(new Registered($user));

        //Call an Event and listener
        if ($request->subscribe) {
            event(new UserSubscribed($user));
        }

        //Redirect
        return redirect()->route('dashboard');
    }

    //Verify Email Notice Handler
    public function verifyNotice() {
        return view('auth.verify-email');
    }

    //Email Verification Handler
    public function verifyEmail(EmailVerificationRequest $request) {

        $request->fulfill();

        return redirect()->route('dashboard');
    }

    //Resending the Verification Email Route
    public function verifyHandler(Request $request) {

        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
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
