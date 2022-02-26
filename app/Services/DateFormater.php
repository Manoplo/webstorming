<?php

namespace App\Services;

use Carbon\Carbon;

/**
 * DateFormater Service has methods to format different dates and times using Carbon to serve formatted dates to JS front-end
 */
class DateFormater
{


    /**
     * Applies carbon dateDiff to a given created_at field in an array
     * @param Array $arr
     * @return Array
     */

    public function dateDiff($arr)
    {

        foreach ($arr as $item) {

            $carbon = new Carbon();
           
            $item->created_at = $carbon->diffForHumans($item->created_at);
        }

        return $arr;
    }
    /**
     * Applies carbon dateDiff to a given created_at field in an array
     *
     * @param Array $arr
     * @return Array
     */
    public function formatArrayOfDates($arr)
    {
        $arrOfDates = [];
        foreach ($arr as $item) {
            array_push($arrOfDates, $this->singleDateDiff($item));
            
        }

        for ($i=0; $i < count($arr) ; $i++) { 
            $arr[$i]->formatedDate = $arrOfDates[$i];
        }

        return $arr;
    }
        
    /**
     * Takes an object with timestamp and returns a string with the difference between the current time and the timestamp
     *
     * @param Object $item
     * @return String
     */
    public function singleDateDiff($item)
    {
        $now = Carbon::now();
        $postDiff = $now->diffForHumans($item->created_at); 
        return $postDiff;
    }
}