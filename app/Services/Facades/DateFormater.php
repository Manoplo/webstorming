<?php 

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class DateFormater extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dateformater';
    }
}