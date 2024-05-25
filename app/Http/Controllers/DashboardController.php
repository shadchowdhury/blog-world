<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller               //implements HasMiddleware {for learning purpose}
{
    // public static function middleware(): array
    // {
    //     return [
    //         'auth'
    // ];
    // }

    public function index() {
        // $posts = Post::where('user_id', Auth::id())->get(); //One Way.

        // Another way
        $posts = Auth::user()->posts()->latest()->paginate(6);

        return view('users.dashboard', ['posts' => $posts]);
    }
}
