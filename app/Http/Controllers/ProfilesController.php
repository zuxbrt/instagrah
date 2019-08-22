<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    /**
     * Displays user profile.
     */
    public function index(User $user)
    {
        // return state if the user is already following current profile.
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postsCount = Cache::remember(
            'count.posts'. $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->posts->count();
            }
        );

        $followersCount = Cache::remember(
            'count.followers'. $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->profile->followers->count();
            }
        );

        $followingCount = Cache::remember(
            'count.followers'. $user->id,
            now()->addSeconds(30),
            function() use ($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }


    /**
     * Edit user info.
     */
    public function edit(User $user)
    {
        // authorization
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }


    /**
     * Update user info.
     */
    public function update(User $user)
    {
        // authorization
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'image' => '',
        ]);

        // if url is entered
        if(request('url') !== null){
            $data['url'] = request('url');
        }

        // in case a new image is added, save it
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        // block unauthorized users
        auth()->user()->profile->update(array_merge(
            $data, 
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
