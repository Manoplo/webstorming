<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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

    public function destroy(Comment $comment)
    {


        $comment->delete();

        return redirect()->back();
    }
}
