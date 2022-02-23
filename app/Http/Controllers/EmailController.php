<?php

namespace App\Http\Controllers;

use App\Mail\ReportedPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function Symfony\Component\String\b;

class EmailController extends Controller
{

    /**
     * Sends a report to site admin about a post with user who reported it and post id. 
     *
     * @param Request $request
     * @return void
     */
    public function sendReport(Request $request){

        $user = User::find($request->user_id);
        $post = Post::find($request->post_id);
        

        $data = [
            'subject' => 'A post has been reported',
            'name' => $user->name,
            'post_id' => $post->id,
        ];

        Mail::to('manueluismartin@gmail.com')->send(new ReportedPost($data));

        return redirect()->back();

    }   
}
