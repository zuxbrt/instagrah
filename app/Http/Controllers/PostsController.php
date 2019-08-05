<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/'. auth()->user()->id);
    }
}
