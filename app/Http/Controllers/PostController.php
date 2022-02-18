<?php

namespace App\Http\Controllers;

use App\Helpers\DateFormater;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{


    public function show(Post $post)
    {
        $user = $post->user;
        $stack = $post->stack;
        $likes = $post->likes->count();
        // Traer los mensajes del post 
        /* $comments = $post->comments; */

        // Traer los comentarios del post con los datos del autor. 
        $comments = Comment::with('author')->where('post_id', $post->id)->get();

        // Como los posts estan individualizados en una vista, puedo comprobar si para cada post el usuario autenticado ha votado. De este modo, puedo 
        // darle un estilo a los botones de votar.
        $votedFor = $post->likes->contains(Auth::id());

        /* 
        $comments = DateFormater::dateDiff($comments);

        dd($comments); */

        $data = [
            'user' => $user,
            'stack' => $stack,
            'post' => $post,
            'comments' => $comments,
            'likes' => $likes,
            'votedFor' => $votedFor

        ];

        return Inertia::render('Post', ['data' => $data]);
    }
}
