<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {



        $data = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('stacks', 'stacks.id', '=', 'posts.stack_id')
            ->select('posts.id', 'posts.title', 'posts.description', 'users.name as user_name', 'users.image as user_image', 'stacks.name as stack_name', 'stacks.image as stack_image')
            ->where('posts.title', 'like', '%' . $request->search . '%')
            ->orWhere('posts.description', 'like', '%' . $request->search . '%')
            ->orWhere('users.name', 'like', '%' . $request->search . '%')
            ->orWhere('stacks.name', 'like', '%' . $request->search . '%')
            ->get();

        return response()->json($data, 200);
    }
}
