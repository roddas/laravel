<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

define('DEFAULT_IMAGE', 'posts_images/default.webp');


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Mail::to('roddas360@gmail.com')->send(new WelcomeMail());
        $post = Post::latest()->paginate(6);
        return view('posts.index', ['posts' => $post]);
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
        // Storage::put('posts_images',$request->image);

        $request->validate([
            'title' => ['required', 'max:250'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:2000', 'mimes:png,jpg,webp'],
        ]);
        $path = 'posts_images/default.webp';
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        Auth::user()
            ->posts()
            ->create([
                'title' => $request->title,
                'body' => $request->body,
                'image' => $path,
            ]);
        return back()->with('success', 'Your post was created');
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
        Gate::authorize('modify', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify', $post);
        $fields = $request->validate([
            'title' => ['required', 'max:250'],
            'body' => ['required'],'image' => ['nullable', 'file', 'max:2000', 'mimes:png,jpg,webp'],

        
        ]);

        $request->validate([
            'title' => ['required', 'max:250'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:2000', 'mimes:png,jpg,webp'],
        ]);
        
        $path = $post->image ?? DEFAULT_IMAGE;
        if ($request->hasFile('image')) {
            if($post->image != DEFAULT_IMAGE){
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
        ]);
        return redirect('dashboard')->with('success', 'Your post was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify', $post);
        if($post->image and $post->image != DEFAULT_IMAGE){
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return back()->with('delete', 'Your post was deleted!');
    }
}
