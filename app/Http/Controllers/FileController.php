<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Image\Image;

class FileController extends Controller
{   

    /**
     * Store a newly created profile avatar image resource in storage. Uses Spatie Image library to resize image.
     *
     * @param FileRequest $request
     * @return void
     */
    public function store(FileRequest $request){


        /**
         * Using spatie/image package to focal-crop the image and save it. 
         */
        
        Image::load($request->file('image'))
        ->focalCrop(200, 200, 300, 300)
        ->save();
        
        $path = $request->file('image')->store('public');

        $user = Auth::user();

        $user->image = asset('storage/' . $request->file('image')->hashName());
        $user->save();

        return redirect()->back();
    }
}
