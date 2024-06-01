<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::latest()->paginate(6);

        return view('posts.index', [ 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $field = $request -> validate([
            'title' => ['required', 'max:255'],
            'body' => ['required']
        ]);

        // create a post
        //Post::create(['user_id' => Auth::id(), ...$field]);  // But it will make problems when we want to grap posts that belongs to user.
        Auth::user()->posts()->create($field);

        // redirect to dashboard
        return back()->with('success','Your post has ceated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
