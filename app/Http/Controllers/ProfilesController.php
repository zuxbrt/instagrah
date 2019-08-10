<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    /**
     * Displays user profile.
     */
    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
    }


    /**
     * Edit user info.
     */
    public function edit(User $user)
    {
        // authorize update only for logged in user
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }


    /**
     * Update user info.
     */
    public function update(User $user)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        // block unauthorized users
        auth()->user()->profile->update($data);

        return redirect("/profile/{$user->id}");
    }
}
