<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{   

    /**
     * Store a newly created profile avatar image resource in storage.
     *
     * @param FileRequest $request
     * @return void
     */
    public function store(FileRequest $request){

       
        $path = $request->file('image')->store('public');

        $user = Auth::user();

        $user->image = asset('storage/' . $request->file('image')->hashName());
        $user->save();

        return redirect()->back();
    }
}
