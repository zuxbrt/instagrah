<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    /**
     * Displays user profile.
     */
    public function index(User $user)
    {
        // return state if the user is already following current profile.
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', compact('user', 'follows'));
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
            'url' => 'url',
            'image' => '',
        ]);

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
