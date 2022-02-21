<?php

namespace App\Http\Controllers;

use App\Models\Stack;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{   
    /**
     * Display a Profile vue component view
     *
     * @param User $user
     * @return Inertia\Response
     */
    public function index(User $user){

        $stacks = Stack::all();
        $numComments = $user->comments()->count();
        $numPosts = $user->posts()->count();

        $info = [
            'numComments' => $numComments,
            'numPosts' => $numPosts,
        ];
        
        return Inertia::render('Profile', ['user' => $user, 'stacks' => $stacks, 'info' => $info]);
        
    }
}
