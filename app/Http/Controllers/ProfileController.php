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
        
        return Inertia::render('Profile', ['user' => $user, 'stacks' => $stacks]);
        
    }
}
