<?php

namespace App\Http\Controllers;


use App\Http\Queries\QueryConstructor;
use App\Models\User;


class CardController extends Controller
{

    /**
     * Get most recent posts with some user and stack info to fullfill the cards. Axios call.
     *
     * @return json
     */
    public function getRecent()
    {
        $query = new QueryConstructor();
        $data = $query->getCardsByMostRecent(6);

        return response()->json($data, 200);
    }

    
    /**
     * Get most popular posts with some user and stack info to fullfill the cards. Axios call.
     *
     * @return json
     */
    public function getByPopular(){
        $query = new QueryConstructor();
        $data = $query->getCardsByMostPopular(6);

        return response()->json($data, 200);
    }
    
    /**
     * Get all posts from a single user with some info to fullfill the cards. Axios call.
     *
     * @param User $user
     * @return json
     */
    public function getByUser(User $user)
    {
        $query = new QueryConstructor();
        $data = $query->getCardsByUser($user->id);


        return response()->json($data, 200);
    }
}
