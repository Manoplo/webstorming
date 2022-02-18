<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostUserController extends Controller
{
    /**
     * Checks whether the user has liked the post or not.
     *
     * @param Post $post
     * @return void
     */
    public function store(Post $post)
    {

        PostUser::firstOrNew(['user_id' => Auth::id(), 'post_id' => $post->id])->toggle();


        return redirect()->back();
    }
}
