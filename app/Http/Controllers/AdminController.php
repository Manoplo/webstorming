<?php

namespace App\Http\Controllers;

use App\Models\Stack;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function listUsers()
    {


        return Inertia::render('Admin/Users', [

            'users' => User::query()->paginate(5),
        ]);
    }
    public function listStacks()
    {
        $stacks = Stack::all();
        return Inertia::render('Admin/Stacks', ['stacks' => $stacks]);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('users');
    }
}
