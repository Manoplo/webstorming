<?php

namespace App\Http\Controllers;

use App\Http\Queries\QueryConstructor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DisplayController extends Controller
{


    public function newest()
    {

        $query = new QueryConstructor();

        $cards = $query->getCardsByRecentWithPagination(6);

        return Inertia::render('DisplayRecent', [
            'cards' => $cards,
        ]);
    }

    public function popular()
    {
        return Inertia::render('DisplayPopular');
    }
}
