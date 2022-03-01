<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Facades\DateFormater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    
    /**
     * Display a listing of the resource. Axios call. 
     *
     * @return json
     */
    public function display(){

        $user = Auth::user();

        if(!$user) return redirect('/');


        $notifications = $user->notifications;

        $notifications = DateFormater::formatArrayOfDates($notifications);

        return response()->json($notifications);
    }
    /**
     * Mark a single notificacion as read
     *
     * @param Request $request
     * @return redirect
     */
    public function markAsRead(Request $request){
        
        Auth::user()->unreadNotifications->where('id', $request->id)->markAsRead();

        return redirect("/posts/{$request->postId}");

    }


}
