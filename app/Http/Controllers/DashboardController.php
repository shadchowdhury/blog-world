<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller               //implements HasMiddleware {for learning purpose}
{
    // public static function middleware(): array
    // {
    //     return [
    //         'auth'
    // ];
    // }

    public function index() {
        return view('users.dashboard');
    }
}
