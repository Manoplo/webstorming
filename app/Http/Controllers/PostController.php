<?php

namespace App\Http\Controllers;

use App\Helpers\DateFormater;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{


    public function show(Post $post)
    {
        $user = $post->user;
        $stack = $post->stack;

        /* $post->create_at = DateFormater::singleDateDiff($post); */

        $data = [
            'user' => $user,
            'stack' => $stack,
            'post' => $post
        ];



        return Inertia::render('Post', ['data' => $data]);
    }
}
