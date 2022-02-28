<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

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
