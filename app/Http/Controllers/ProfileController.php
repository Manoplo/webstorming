<?php

namespace App\Http\Controllers;

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

        return Inertia::render('Profile', ['user' => $user]);
        
    }
}
