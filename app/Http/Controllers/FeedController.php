<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use App\Profile;

class FeedController extends Controller
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
        if(Post::all()->count() > 18){
            $posts = Post::paginate(9);
        } else {
            $posts = Post::simplePaginate(9);
        }

        return view('search.index', compact('posts'));
    }

}
