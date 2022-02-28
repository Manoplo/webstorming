<?php

namespace App\Http\Controllers;

use App\Http\Queries\QueryConstructor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DisplayController extends Controller
{

    /**
     * Display a listing of the resource order by latest. with pagination. Uses QueryConstructor.
     *
     * @return Inertia view
     */
    public function newest()
    {

        $query = new QueryConstructor();

        $cards = $query->getCardsByRecentWithPagination(6);

        return Inertia::render('DisplayRecent', [
            'cards' => $cards,
        ]);
    }
    /**
     * Display a listing of the resource order by popular. with pagination. Uses axios call. 
     *
     * @return Inertia view
     */
    public function popular()
    {
        return Inertia::render('DisplayPopular');
    }
}
