<?php

namespace App\Http\Controllers;

use App\Helpers\DateFormater;
use App\Http\Queries\QueryConstructor;
use App\Models\Post;
use App\Models\User;
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
        $query = new QueryConstructor();
        $data = $query->getCardsByMostRecent(6);

        return response()->json($data, 200);
    }

    public function getByUser(User $user)
    {
        $query = new QueryConstructor();
        $data = $query->getCardsByUser($user->id);


        return response()->json($data, 200);
    }
}
