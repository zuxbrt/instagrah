<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use App\Profile;
use Illuminate\Support\Facades\Storage;

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
     * Display all posts and users to follow.
     */
    public function index()
    {
        $allProfiles = Profile::all();

        //filter current logged profile
        $profiles = $allProfiles->reject(function ($profile, $key) {
           return auth()->User()->id == $profile->user_id;
        });

        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts', 'profiles'));
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
    public function store(Request $request)
    {
        // form request data
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        $fileName = '';

        if ($request->hasFile('image')) {
            $imagePath = request('image')->store('posts/'.auth()->user()->id, 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $fileName = $imagePath;
        }

        // create post
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $fileName,
        ]);

        // redirect to user profile
        return redirect('/profile/'. auth()->user()->id);
    }

    /**
     * Delete post.
     */
    public function destroy(Post $post)
    {
        if($post->user_id !== auth()->User()->id){
            abort(403);
        } else {
            $post->delete();
            return redirect('/profile/'.auth()->User()->id);
        }
        
    }


    /**
     * Return view for show single post.
     */
    public function show(Post $post)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;
        return view('posts.show', compact('post', 'follows'));
    }

}
