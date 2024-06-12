<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['auth','verified'], except: ['index','show']),
        ];
    }

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
        $request -> validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:1024', 'mimes:png,jpg,webp']
        ]);

        // Store images if exist
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        // create a post
        //Post::create(['user_id' => Auth::id(), ...$field]);  // But it will make problems when we want to grap posts that belongs to user.
        $post = Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

        //Sending Emails to user
        Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $post));

        // redirect to dashboard
        return back()->with('success','Your post has been ceated successfully');
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
        //Authorizing the action
        Gate::authorize('modify', $post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //Authorizing the action
        Gate::authorize('modify', $post);

        //Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:1024', 'mimes:png,jpg,webp']
        ]);

        // Update image if exist
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        //Update the post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

        //redirect to dashboard
        return redirect()->route('dashboard')->with('success', 'Your post has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //Authorizing the action
        Gate::authorize('modify', $post);

        //Delete post image if exist
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        //Delete the post
        $post->delete();

        //Redirect to Dashboard
        return back()->with('delete','Your post was deleted successfully');

    }
}
