<?php

namespace App\Http\Controllers;


use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Stack;
use App\Services\Facades\DateFormater;
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

        
        
        // Formateo la fecha de creación de cada uno de los comentarios
        $comments =  DateFormater::formatArrayOfDates($comments);
        
        // Formatear la fecha de publicación del post. 
        $postDiff = DateFormater::singleDateDiff($post);
        

        

        /* $post = DateFormater::singleDateDiff($post); */
        

        $data = [
            'user' => $user,
            'stack' => $stack,
            'post' => $post,
            'comments' => $comments,
            'likes' => $likes,
            'votedFor' => $votedFor,
            'postDiff' => $postDiff,

        ];

        return Inertia::render('Post', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return redirect
     */
    public function store(PostRequest $request)
    {
        $request->merge(['user_id' => Auth::id()]);

        $post = Post::create($request->all());

        
            
        return redirect("/posts/$post->id")->with('message', 'A new idea is born. We hope it reaches the stars :)');
        
    }
    /**
     * Destroys the specified resource.
     *
     * @param Post $post
     * @return redirect
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect("profiles/".Auth::user()->id)->with('message', 'Your idea has been deleted');
    }
    /**
     * Displays the form to edit the specified resource.
     *
     * @param Post $post
     * @return Inertia\Response
     */
    public function edit(Post $post)
    {

        $user = $post->user;
        $stack = $post->stack;
        $stacks = Stack::all();

        if($user->id !== Auth::user()->id && !Auth::user()->is_admin) {
            return redirect("/posts/$post->id")->with('message', 'You are not allowed to edit this post');
        }

        return Inertia::render('PostEdit', ['post' => $post, 'stack' => $stack, 'stacks' => $stacks]);

    }


    /**
     * Updates the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return redirect
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        return redirect("/posts/$post->id")->with('message', 'Your idea has been updated');
    }
}
