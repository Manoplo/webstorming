<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * DateFormater class has methods to format different dates and times using Carbon to serve formatted dates to JS front-end
 */
class DateFormater
{


    /**
     * Applies carbon dateDiff to a given created_at field in an array
     * @param Array $arr
     * @return Array
     */

    public static function dateDiff($arr)
    {

        foreach ($arr as $item) {

            $carbon = new Carbon();
            $item->created_at = $carbon->diffForHumans($item->created_at);
        }

        return $arr;
    }

    public static function singleDateDiff($item)
    {
        $carbon = new Carbon();
        $item->created_at = $carbon->diffForHumans($item->created_at);

        return $item;
    }
}
