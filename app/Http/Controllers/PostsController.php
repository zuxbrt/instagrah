<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;

class PostsController extends Controller
{
    /**
     * Authorization check - methods below can be accessed only
     * if the user is logged in.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all posts.
     */
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Return view for create post method.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Handle creating post to currently logged in user.
     */
    public function store()
    {
        // form request data
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        // upload image
        $imagePath = request('image')->store('uploads', 'public');

        // fit its size
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        // create post
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        // redirect to user profile
        return redirect('/profile/'. auth()->user()->id);
    }


    /**
     * Return view for show single post.
     */
    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }

}
