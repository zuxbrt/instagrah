<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use App\Profile;

class SearchController extends Controller
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
        dd('selam');
        // $allProfiles = Profile::all();

        // // filter current logged profile
        // $profiles = $allProfiles->reject(function ($profile, $key) {
        //     return auth()->User()->id == $profile->user_id;
        // });

        // $users = auth()->user()->following()->pluck('profiles.user_id');
        // $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        // return view('posts.index', compact('posts', 'profiles'));
    }

}
