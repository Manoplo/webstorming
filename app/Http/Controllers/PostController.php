<?php

namespace App\Http\Controllers;

use App\Helpers\DateFormater;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{

    /**
     * Display a single Post vue component with its data and the messages tied to it. 
     *
     * @param Post $post
     * @return Inertia\Response
     */
    public function show(Post $post)
    {

        $user = $post->user;
        $stack = $post->stack;
        $likes = $post->likes->count();
        

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

    public function store(PostRequest $request)
    {
        $request->merge(['user_id' => Auth::id()]);

        $post = Post::create($request->all());

        
            
        return redirect("/posts/$post->id")->with('message', 'A new idea is born. We hope it reaches the stars :)');
        
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect("profiles/".Auth::user()->id)->with('message', 'Your idea has been deleted');
    }
}
