<?php

namespace App\Http\Controllers;

use App\Helpers\DateFormater;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{

    /**
     * Get most recent posts with some user and stack info to fullfill the cards. Axios call.
     *
     * @return json
     */
    public function getRecent()
    {

        /**
         * Query Builder axios response. 
         */
        $cardData = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('stacks', 'stacks.id', '=', 'posts.stack_id')
            ->select('posts.id', 'posts.title', 'posts.description', 'posts.created_at', 'users.name as user_name', 'users.image as user_image', 'stacks.name as stack_name', 'stacks.image as stack_image')
            ->orderBy('posts.created_at', 'desc')
            ->limit(6)
            ->get();


        /**
         * Using custom DateFormater class to serve json formatted data. 
         */
        $cardData = DateFormater::dateDiff($cardData);

        return response()->json($cardData, 200);
    }
}
