<?php

namespace App\Http\Controllers;

use App\Helpers\DateFormater;
use App\Models\Comment;
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
        // Traer los mensajes del post 
        /* $comments = $post->comments; */

        // Traer los comentarios del post con los datos del autor. 
        $comments = Comment::with('author')->where('post_id', $post->id)->get();

        
/* 
        $comments = DateFormater::dateDiff($comments);

        dd($comments); */

        $data = [
            'user' => $user,
            'stack' => $stack,
            'post' => $post,
            'comments' => $comments,

        ];

        return Inertia::render('Post', ['data' => $data]);
    }
}
