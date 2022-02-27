<?php

namespace App\Http\Controllers;

use App\Models\Stack;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AdminController extends Controller
{   

    /**
     * Display a listing of the resource.
     *
     * @return Inertia view
     */
    public function listUsers()
    {


        return Inertia::render('Admin/Users', [

            'users' => User::query()->paginate(5),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Inertia view
     */
    public function listStacks()
    {
        
        return Inertia::render('Admin/Stacks', ['stacks' => Stack::query()->paginate(5)]);
    }

    /**
     * Store a new user
     *
     * @param Request $request
     * @return redirect
     */
    public function createUser(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'bio' => 'required|max:255',
            'location' => 'required|max:255',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'location' => $request->location,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('message', 'User created');

    }
    /**
     * Store a new stack
     *
     * @param Request $request
     * @return redirect
     */
    public function createStack(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'image' => 'required|url',
            
        ]);

        Stack::create([
            'name' => $request->name,
            'image' => $request->image, 
        ]);

        return redirect()->back()->with('message', 'Stack created');

    }
    /**
     * Destroy the specified resource.
     *
     * @param User $user
     * @return redirect
     */
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('users');
    }

    /**
     * Destroy the specified resource.
     *
     * @param Stack $stack
     * @return redirect
     */
    public function deleteStack(Stack $stack)
    {
        $stack->delete();
        return redirect()->route('stacks');
    }
}
