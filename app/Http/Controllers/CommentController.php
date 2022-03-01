<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return redirect
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'body' => 'required|min:3'
        ]);

        if (!$validated) {
            return response()->json([
                'message' => 'Comment is required and must be at least 3 characters long.'
            ], 422);
        }

        Comment::create($request->all());

        /**
         * Send notification to the user who created the post
         */
        $post = Post::find($request->post_id);
        $creator = $post->user;
       
        $commenter = Auth::user();
        /**
         * Dont send notification to the user himself
         */
        if ($creator->id !== $commenter->id) {
            $creator->notify(new \App\Notifications\CommentsNotification($post->id, $commenter->name, $commenter->image));
        }
        

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return redirect
     */
    public function destroy(Comment $comment)
    {


        $comment->delete();

        return redirect()->back();
    }
}
