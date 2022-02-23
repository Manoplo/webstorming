<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Stack;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Display a Profile vue component view
     *
     * @param User $user
     * @return Inertia\Response
     */
    public function index(User $user)
    {

        $stacks = Stack::all();
        $numComments = $user->comments()->count();
        $numPosts = $user->posts()->count();
        $numLikes = $user->posts()->with('likes')->count();

        $info = [
            'numComments' => $numComments,
            'numPosts' => $numPosts,
            'numLikes' => $numLikes
        ];

        return Inertia::render('Profile', ['user' => $user, 'stacks' => $stacks, 'info' => $info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @param User $user
     * @return redirect
     *
     */
    public function update(ProfileRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
