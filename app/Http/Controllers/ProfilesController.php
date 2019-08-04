<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Displays user profile.
     */
    public function index($user)
    {
        $user = \App\User::find($user);
        return view('home', [
            'user' => $user,
        ]);
    }
}
