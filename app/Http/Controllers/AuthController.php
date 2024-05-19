<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //Register User
    public function register(Request $request) {
        dd($request->username);
    }
}
